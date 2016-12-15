<?php
declare(strict_types = 1);

require_once __DIR__ . '/../../../vendor/autoload.php';

$input = file(__DIR__ . '/input.txt');

$discs = [];
foreach ($input as $discDesc) {
    //Disc #1 has 17 positions; at time=0, it is at position 1.
    preg_match(
        '/Disc #\d has (?P<positions>\d+) positions; at time=0, it is at position (?P<start>\d+)/',
        $discDesc,
        $matches
    );

    $discs[] = new \Advent\Day15\Disc((int)$matches['positions'], (int)$matches['start']);
}

$diskStack = new \Advent\Day15\DiscStack(... $discs);

echo "Part 1: The button should be pressed at time " . $diskStack->getFirstAlignmentTime() . "\n";

$discs[] = new \Advent\Day15\Disc(11, 0);

$newDiskStack = new \Advent\Day15\DiscStack(...$discs);
echo "Part 2: The button should be pressed at time " . $newDiskStack->getFirstAlignmentTime() . "\n";