<?php
declare(strict_types = 1);

require_once __DIR__ . '/../../../vendor/autoload.php';

$checker = new \Advent\Day3\TriangleChecker();

$input = file(__DIR__ . '/input.txt');

$possibleCount = 0;

for ($i = 0; $i < count($input); $i+=3) {
    preg_match('/(\d+)\s+(\d+)\s+(\d+)/', $input[$i], $matches1);
    preg_match('/(\d+)\s+(\d+)\s+(\d+)/', $input[$i+1], $matches2);
    preg_match('/(\d+)\s+(\d+)\s+(\d+)/', $input[$i+2], $matches3);

    if ($checker->validate((int) $matches1[1], (int) $matches2[1], (int) $matches3[1])) {
        $possibleCount++;
    }
    if ($checker->validate((int) $matches1[2], (int) $matches2[2], (int) $matches3[2])) {
        $possibleCount++;
    }
    if ($checker->validate((int) $matches1[3], (int) $matches2[3], (int) $matches3[3])) {
        $possibleCount++;
    }
}

echo "There are $possibleCount possible triangles.\n";