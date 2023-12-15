<?php

require_once 'vendor/autoload.php';
require_once 'function.php';

$start_time = microtime(true);

$bin = 'php';
$file = __DIR__ . '/child-process.php';

for ($month = 1; $month <= 12; $month++) {
    $process = new \React\ChildProcess\Process($bin . ' ' . $file);

    $process->start();
    $process->stdin->write($month);
}

$finish = microtime(true);

writeToLog('process', 'Script ended', $start_time, $finish);