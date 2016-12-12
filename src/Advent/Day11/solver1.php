<?php
declare(strict_types = 1);

require_once __DIR__ . '/../../../vendor/autoload.php';

$building = new \Advent\Day11\Building();

$building->storeItem(new \Advent\Day11\Generator('strontium'), 1);
$building->storeItem(new \Advent\Day11\Microchip('strontium'), 1);
$building->storeItem(new \Advent\Day11\Generator('plutonium'), 1);
$building->storeItem(new \Advent\Day11\Microchip('plutonium'), 1);

$building->storeItem(new \Advent\Day11\Generator('thulium'), 2);
$building->storeItem(new \Advent\Day11\Generator('ruthenium'), 2);
$building->storeItem(new \Advent\Day11\Microchip('ruthenium'), 2);
$building->storeItem(new \Advent\Day11\Generator('curium'), 2);
$building->storeItem(new \Advent\Day11\Microchip('curium'), 2);

$building->storeItem(new \Advent\Day11\Microchip('thulium'), 3);

foreach (range(1, 4) as $floor) {
    echo $building->isFloorSafe($floor) ? "Floor $floor is safe" : "Floor $floor is not safe";
    echo "\n";
}
