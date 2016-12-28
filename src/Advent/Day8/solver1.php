<?php
declare(strict_types = 1);

require_once __DIR__ . '/../../../vendor/autoload.php';

$grid   = new \Advent\Day8\Grid(50, 6);
$parser = new \Advent\Day8\CommandParser($grid);

$input = file(__DIR__ . '/input.txt');

foreach ($input as $line) {
    $parser->parse($line);
}

echo "There are " . $grid->getLitCount() . " lit stuff\n";

echo $grid;
