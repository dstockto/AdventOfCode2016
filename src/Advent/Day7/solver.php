<?php
declare(strict_types = 1);

require_once __DIR__ . '/../../../vendor/autoload.php';

$input = collect(file(__DIR__ . '/input.txt'));

$addresses = $input->map(
    function ($line) {
        return new \Advent\Day7\IPAddress($line);
    }
);

$tlsAddresses = $addresses->filter(
    function (\Advent\Day7\IPAddress $ipAddress) {
        return $ipAddress->supportsTLS();
    }
);

$sslAddresses = $addresses->filter(
    function (\Advent\Day7\IPAddress $ipAddress) {
        return $ipAddress->supportsSSL();
    }
);

echo "There are " . $tlsAddresses->count() . " Addresses that support TLS\n";
echo "There are " . $sslAddresses->count() . " Addresses that support SSL\n\n";

$sslAddresses->each(
    function (\Advent\Day7\IPAddress $ipAddress) {
        echo $ipAddress->getAddress() . "\n";
        echo "ABAs: " . implode(', ', $abas = $ipAddress->getABAs()) . "\n";
        echo "BABs: " . implode(', ', $ipAddress->getBABs($abas)) . "\n\n\n";
    }
);