<?php


function writeToLog(string $message, float $start, float $finish, $month = null): void
{
    $diff = $finish - $start;
    $log = "\n------------------------\n";
    $log .= date("Y.m.d H:i:s") . "\n";
    $log .= print_r(['message' => $message, 'month' => $month, 'start' => $start, 'finish' => $finish, 'total' => $diff], true);
    $log .= "\n------------------------\n";
    file_put_contents(__DIR__ . "/log.log", $log, FILE_APPEND);
}