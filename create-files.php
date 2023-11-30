<?php

require_once 'vendor/autoload.php';

$start_time = microtime(true);

$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'bitrix_local';
$pdo = new PDO("mysql:host=$host;dbname=$db_name", $user , $pass);

for ($month = 1; $month <= 12; $month++) {
//    $current_directory = __DIR__ . '/' . $month;
//
//    if (!is_dir($current_directory)) {
//        mkdir($current_directory);
//    }

    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $user , $pass);
    for ($i = 0; $i < 300; $i++) {
        $time = microtime(true);
        $result = $pdo->query("SELECT SQL_NO_CACHE $time");
        $result->fetch();


//        file_put_contents("$current_directory/$month-$time.txt", print_r(['month' => $month, 'time' => $time], true), FILE_APPEND);
    }
    unset($pdo);
}

$finish = microtime(true);
$diff = $finish - $start_time;

writeToLog($diff);

function writeToLog(float $time): void
{
    $log = "\n------------------------\n";
    $log .= date("Y.m.d H:i:s") . "\n";
//            $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
    $log .= print_r(['message' => 'Script ended', 'time' => $time], true);
    $log .= "\n------------------------\n";
    file_put_contents(__DIR__ . "/log.log", $log, FILE_APPEND);
}
