<?php
declare(strict_types = 1);

namespace Advent\Day10;

class ReceiverContainer
{
    private $bots = [];
    private $outputs = [];

    public function store(ChipReceiver $receiver)
    {
        if ($receiver instanceof Bot) {
            $this->bots[$receiver->getNumber()] = $receiver;
        } elseif ($receiver instanceof OutputBin) {
            $this->outputs[$receiver->getNumber()] = $receiver;
        }
    }

    public function getBot(int $botId): Bot
    {
        if (isset($this->bots[$botId])) {
            return $this->bots[$botId];
        }

        throw new \RuntimeException('No bot found for that ID');
    }

    public function getOutputbin(int $binId): OutputBin
    {
        if (isset($this->outputs[$binId])) {
            return $this->outputs[$binId];
        }

        throw new \RuntimeException('No output bin found for that ID');
    }
}
