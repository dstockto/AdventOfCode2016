<?php
declare(strict_types = 1);

namespace Advent\Day10;

class ChipInstructionParser
{
    /** @var ReceiverContainer */
    private $container;

    public function __construct(ReceiverContainer $container)
    {
        $this->container = $container;
    }

    public function parseLine(string $line)
    {
        preg_match('/value (?P<chipId>\d+) goes to bot (?P<botId>\d+)/', $line, $matches);
        $chip = new Microchip((int)$matches['chipId']);
        $this->container->getBot((int)$matches['botId'])->giveChip($chip);
    }
}
