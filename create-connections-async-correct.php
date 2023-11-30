<?php

require_once 'vendor/autoload.php';
require_once 'function.php';

$start_time = microtime(true);

$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'mysql';
$pdo = new PDO("mysql:host=$host;dbname=$db_name", $user , $pass);

\React\Async\async(function () {
    for ($month = 1; $month <= 12; $month++) {
        $promises[] = \React\Async\async(function () use($month) {
            $open_start = microtime(true);
            global $host, $db_name, $user, $pass;

            $pdo = new PDO("mysql:host=$host;dbname=$db_name", $user , $pass);

            $open_ended = microtime(true);

            writeToLog('async-all', 'Opening connection', $open_start, $open_ended, $month);

            for ($i = 0; $i < 300; $i++) {
                $time = microtime(true);
                $result = $pdo->query("SELECT SQL_NO_CACHE $time");
                $result->fetch();
            }
            unset($pdo);
        });
    }

    \React\Async\await(\React\Promise\all($promises));
})();

$finish = microtime(true);

writeToLog('async-all', 'Script ended', $start_time, $finish);
