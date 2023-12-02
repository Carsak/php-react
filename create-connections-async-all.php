<?php

require_once 'vendor/autoload.php';
require_once 'function.php';

$start_time = microtime(true);

\React\Async\async(function () {
    for ($month = 1; $month <= 12; $month++) {
        $promises[] = \React\Async\async(function () use($month) {
            $open_start = microtime(true);
            file_get_contents('https://httpbin.org/delay/1');
            $open_ended = microtime(true);

            writeToLog('async-all', 'Opening connection', $open_start, $open_ended, $month);

            return 1;
        });
    }

    \React\Async\await(\React\Promise\all($promises));
})();

$finish = microtime(true);

writeToLog('async-all', 'Script ended', $start_time, $finish);
