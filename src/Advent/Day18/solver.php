<?php
declare(strict_types = 1);

require_once __DIR__ . '/../../../vendor/autoload.php';

$rogueMap = new \Advent\Day18\RogueMap();
$lines = 1;
$start = '......^.^^.....^^^^^^^^^...^.^..^^.^^^..^.^..^.^^^.^^^^..^^.^.^.....^^^^^..^..^^^..^^.^.^..^^..^^^..';
echo "$start\n";

$safeSpots = getSafeSpots($start);

foreach ($rogueMap($start) as $line) {
    $lines++;
//    echo "$line\n";
    $safeSpots += getSafeSpots($line);
    if ($lines == 400000 ) {
        break;
    }
}

echo "Safe spots: $safeSpots\n";


function getSafeSpots(string $line): int
{
    return preg_match_all('#\.#', $line);
}
