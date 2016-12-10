<?php
declare(strict_types = 1);

namespace Advent\Day10;

class Bot implements ChipReceiver
{
    /**
     * @var string
     */
    private $loReceiver;
    /**
     * @var string
     */
    private $hiReceiver;
    /**
     * @var int
     */
    private $botId;
    /**
     * @var ReceiverContainer
     */
    private $container;
    /** @var Microchip[] */
    private $chips;
    /** @var BotObserver */
    private $observer;

    public function __construct(
        string $loReceiver,
        string $hiReceiver,
        int $botId,
        ReceiverContainer $container,
        BotObserver $observer
    ) {
        $this->loReceiver = $loReceiver;
        $this->hiReceiver = $hiReceiver;
        $this->botId      = $botId;
        $this->container  = $container;
        $this->chips      = [];
        $this->observer   = $observer;
    }

    public function giveChip(Microchip $chip)
    {
        $this->chips[] = $chip;

        if (count($this->chips) == 2) {
            $lo = $this->getLowReceiver();
            $hi = $this->getHiReceiver();

            $this->observer->__invoke($this, $this->chips[0], $this->chips[1]);

            $chip1Value = $this->chips[0]->getValue();
            $chip2Value = $this->chips[1]->getValue();

            if ($chip1Value < $chip2Value) {
                $lo->giveChip($this->chips[0]);
                $hi->giveChip($this->chips[1]);
            } else {
                $hi->giveChip($this->chips[0]);
                $lo->giveChip($this->chips[1]);
            }

            $this->chips = [];
        }
    }

    public function getNumber()
    {
        return $this->botId;
    }

    private function getLowReceiver(): ChipReceiver
    {
        return $this->getReceiver($this->loReceiver);
    }

    private function getHiReceiver(): ChipReceiver
    {
        return $this->getReceiver($this->hiReceiver);
    }

    /**
     * @param $matches
     * @return Bot
     */
    private function getReceiver(string $receiver): ChipReceiver
    {
        if (preg_match('/Bot(?P<number>\d+)/', $receiver, $matches)) {
            return $this->container->getBot((int)$matches['number']);
        } elseif (preg_match('/Output(?P<number>\d+)/', $receiver, $matches)) {
            return $this->container->getOutputbin((int)$matches['number']);
        }
    }
}
