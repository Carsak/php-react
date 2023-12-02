<?php
require_once 'vendor/autoload.php';
require_once 'function.php';

$start_time = microtime(true);


$stream = new \React\Stream\ReadableResourceStream(STDIN);

$month = '';

$stream->on('data', function ($data) use($start_time, $stream, &$month) {
    file_get_contents('https://httpbin.org/delay/1');

    $month = $data;
    $finish = microtime(true);
    writeToLog('process', 'Child process On event', $start_time, $finish, $month);
    $stream->close();
});

$stream->on('close', function () use($start_time, &$month) {
    $finish = microtime(true);
    writeToLog('process', 'Child process close event' , $start_time, $finish, $month);
});


