<?php
declare(strict_types = 1);

require_once __DIR__ . '/../../../vendor/autoload.php';

$input = collect(file(__DIR__ . '/input.txt'));

$chipInstructions = [];

$container             = new \Advent\Day10\ReceiverContainer();
$botObserver           = new \Advent\Day10\BotObserver(61, 17);
$botSpecParser         = new \Advent\Day10\BotSpecParser($container, $botObserver);
$chipInstructionParser = new \Advent\Day10\ChipInstructionParser($container);

// Add output bins
collect(range(0, 20))->each(
    function ($i) use ($container) {
        $container->store(new \Advent\Day10\OutputBin($i));
    }
);

// Attach observer to bins 0-2
$outputObserver = new \Advent\Day10\OutputObserver();
collect(range(0, 2))->each(
    function ($binId) use ($container, $outputObserver) {
        $container->getOutputbin($binId)->addObserver($outputObserver);
    }
);

$input->reject(
    function ($line) use ($botSpecParser) {
        return $botSpecParser->parseLine($line);
    }
)->each(
    function ($chipInstruction) use ($chipInstructionParser) {
        $chipInstructionParser->parseLine($chipInstruction);
    }
);

echo "The bot which compared chip 61 and 17 was Bot ID " . implode(', ', $botObserver->getBotIds()) . "\n";
echo "The product of the chip Ids in bins 0, 1 and 2 is " . $outputObserver->getChipIdProduct() . "\n";
