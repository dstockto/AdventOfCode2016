<?php
declare(strict_types = 1);

require_once __DIR__ . '/../../../vendor/autoload.php';

$cracker = new \Advent\Day22\SafeCracker();

$input = file(__DIR__ . '/input.txt');

$cracker->execute('cpy 7 a');
$cracker->loadInstructions($input);

$cracker->runProgram();

echo $cracker;
