<?php
declare(strict_types = 1);

require_once __DIR__ . '/../../../vendor/autoload.php';
$curver = new \Advent\Day16\DragonCurver();

$disk = 35651584;
$input = '10001110011110000';
while (strlen($input) < $disk) {
    $input = $curver->curve($input);
}
// trim to disk size
$input = substr($input, 0, $disk);

$checksum = $curver->checksum($input);

echo "The checksum is $checksum\n";

echo xdebug_peak_memory_usage() . "\n";
