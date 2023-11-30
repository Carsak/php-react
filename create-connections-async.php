<?php

require_once 'vendor/autoload.php';
require_once 'function.php';

$start_time = microtime(true);

$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'bitrix_local';
$pdo = new PDO("mysql:host=$host;dbname=$db_name", $user , $pass);

for ($month = 1; $month <= 12; $month++) {
    \React\Async\async(function () use($host, $db_name, $user, $pass) {
        $open_start = microtime(true);

        $pdo = new PDO("mysql:host=$host;dbname=$db_name", $user , $pass);

        $open_ended = microtime(true);

        writeToLog('Opening connection', $open_start, $open_ended);

        for ($i = 0; $i < 300; $i++) {
            $time = microtime(true);
            $result = $pdo->query("SELECT SQL_NO_CACHE $time");
            $result->fetch();
        }
        unset($pdo);
    })();
}

$finish = microtime(true);

writeToLog('Script ended', $start_time, $finish);
