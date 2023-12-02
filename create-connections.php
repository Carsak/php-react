<?php

require_once 'vendor/autoload.php';
require_once 'function.php';

$start_time = microtime(true);


for ($month = 1; $month <= 12; $month++) {
    $open_start = microtime(true);

    file_get_contents('https://httpbin.org/delay/1');

    $open_ended = microtime(true);

    writeToLog('sync', 'Opening connection', $open_start, $open_ended, $month);
}

$finish = microtime(true);

writeToLog('sync', 'Script ended', $start_time, $finish);
