<?php
declare(strict_types = 1);

namespace Advent\Day6;

class FrequencyCounter
{
    private $count = [];

    public function count($letter): void
    {
        if (!isset($this->count[$letter])) {
            $this->count[$letter] = 0;
        }
        $this->count[$letter]++;
    }

    public function getCount($letter): int
    {
        return $this->count[$letter];
    }

    public function getMostFrequent(): string
    {
        arsort($this->count);
        reset($this->count);
        return key($this->count);
    }

    public function getLeastFrequentLetter(): string
    {
        asort($this->count);
        reset($this->count);
        return key($this->count);
    }
}
