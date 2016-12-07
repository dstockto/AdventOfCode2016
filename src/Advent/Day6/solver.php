<?php
declare(strict_types = 1);
require_once __DIR__ . '/../../../vendor/autoload.php';

$size = 8;
/** @var \Advent\Day6\FrequencyCounter $counters */
$counters = [];
for ($i = 0; $i < $size; $i++) {
    $counters[$i] = new \Advent\Day6\FrequencyCounter();
}

$input = file(__DIR__ . '/input.txt');
foreach ($input as $line) {
    foreach (str_split(trim($line)) as $pos => $char) {
        $counters[$pos]->count($char);
    }
}

$counterCollection = collect($counters);
$answer = $counterCollection->map(
    function (\Advent\Day6\FrequencyCounter $counter) {
        return $counter->getMostFrequent();
    }
)->implode('');

echo "$answer\n";
