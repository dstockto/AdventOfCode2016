<?php
declare(strict_types = 1);

require_once __DIR__ . '/../../../vendor/autoload.php';

$input = file(__DIR__ . '/input.txt');

$sectorTotal = 0;

foreach ($input as $roomString) {
    $room = new \Advent\Day4\Room($roomString);
    if ($room->isRealRoom()) {
        if (strpos($room->getDecryptedName(), 'northpole') !== false) {
            echo $room->getDecryptedName() . ' - ' . $room->getSectorId() . "\n";
        }
    }
}
