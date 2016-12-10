<?php
declare(strict_types = 1);

namespace Advent\Day10;

class OutputBin implements ChipReceiver
{
    /**
     * @var int
     */
    private $number;

    private $chips;
    /** @var OutputObserver */
    private $observer;

    public function __construct(int $number)
    {
        $this->number = $number;
        $this->chips  = [];
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function giveChip(Microchip $chip)
    {
        if (!is_null($this->observer)) {
            $this->observer->__invoke($chip);
        }
        $this->chips[$chip->getValue()] = $chip;
    }

    public function hasChip(int $chipId)
    {
        return isset($this->chips[$chipId]);
    }

    public function getChips(): array
    {
        ksort($this->chips);
        return $this->chips;
    }

    public function addObserver(OutputObserver $observer)
    {
        $this->observer = $observer;
    }
}
