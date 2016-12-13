<?php
declare(strict_types = 1);

require_once __DIR__ . '/../../../vendor/autoload.php';

$input = file(__DIR__ . '/optimized.txt');

//$input = file(__DIR__ . '/input_test.txt');

$computer = new \Advent\Day12\Computer();
$computer->execute('cpy 1 c');
$computer->loadInstructions($input);
$computer->runProgram();
echo $computer;
