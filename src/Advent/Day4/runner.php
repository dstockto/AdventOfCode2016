<?php
declare(strict_types = 1);

require_once __DIR__ . '/../../../vendor/autoload.php';

$input = file(__DIR__ . '/input.txt');

$sectorTotal = 0;

foreach ($input as $roomString) {
    $room = new \Advent\Day4\Room($roomString);
    if ($room->isRealRoom()) {
        $sectorTotal += $room->getSectorId();
    }
}

echo "Sector ID total is $sectorTotal\n";