<?php
declare(strict_types = 1);

namespace Advent\Day15;

class Disc
{
    /**
     * @var int
     */
    private $positions;
    /**
     * @var int
     */
    private $start;

    public function __construct(int $positions, int $start)
    {
        $this->positions = $positions;
        $this->start     = $start;
    }

    public function isAligned(int $time): bool
    {
        return (($time + $this->start) % $this->positions) == 0;
    }
}
