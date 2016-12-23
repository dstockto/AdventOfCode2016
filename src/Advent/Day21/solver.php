<?php
declare(strict_types = 1);

require_once __DIR__ . '/../../../vendor/autoload.php';

$instructions = file(__DIR__ . '/input.txt');
$input = 'abcdefgh';
$controller   = new \Advent\Day21\ScrambleController();

echo "Scrambled is " . $controller->processInstructions($input, $instructions) . "\n";

// TODO This is not working yet, some part is not exactly reversing things
echo "Unscrambled is " . $controller->unscramble('fbgdceah', $instructions) . "\n";
