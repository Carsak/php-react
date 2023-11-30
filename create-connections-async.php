<?php

require_once 'vendor/autoload.php';

$start_time = microtime(true);

$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'bitrix_local';
$pdo = new PDO("mysql:host=$host;dbname=$db_name", $user , $pass);

for ($month = 1; $month <= 12; $month++) {
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
}

$finish = microtime(true);

writeToLog('Script ended', $start_time, $finish);

function writeToLog(string $message, float $start, float $finish): void
{
    $diff = $finish - $start;
    $log = "\n------------------------\n";
    $log .= date("Y.m.d H:i:s") . "\n";
    $log .= print_r(['message' => $message, 'start' => $start, 'finish' => $finish, 'total' => $diff], true);
    $log .= "\n------------------------\n";
    file_put_contents(__DIR__ . "/log.log", $log, FILE_APPEND);
}
