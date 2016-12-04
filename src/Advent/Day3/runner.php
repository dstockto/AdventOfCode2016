<?php
declare(strict_types = 1);

require_once __DIR__ . '/../../../vendor/autoload.php';

$checker = new \Advent\Day3\TriangleChecker();

$input = file(__DIR__ . '/input.txt');

$possibleCount = 0;

foreach ($input as $line) {
    preg_match('/(\d+)\s+(\d+)\s+(\d+)/', $line, $matches);
    if ($checker->validate((int) $matches[1], (int) $matches[2], (int) $matches[3])) {
        $possibleCount++;
    }
}

echo "There are $possibleCount possible triangles.\n";