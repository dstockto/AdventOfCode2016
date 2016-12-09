<?php
declare(strict_types = 1);

require_once __DIR__ . '/../../../vendor/autoload.php';

$input = file_get_contents(__DIR__ . '/input.txt');

$decompressor = new \Advent\Day9\Decompressor();
echo "Decompressed length is " . strlen($decompressor->decompress($input)) . "\n";

echo "V2 Decompressed length is " . $decompressor->decompressV2($input) . "\n\n";
