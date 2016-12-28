<?php
declare(strict_types = 1);

namespace Advent\Day15;

class DiscStack
{
    /**
     * @var Disc[]
     */
    private $discs;

    public function __construct(Disc ... $discs)
    {
        $this->discs = $discs;
    }

    public function getFirstAlignmentTime(): int
    {
        $time = 0;
        while (!$this->allAligned($time)) {
            $time++;
        }

        return $time;
    }

    private function allAligned(int $time): bool
    {
        foreach ($this->discs as $num => $disc) {
            if (!$disc->isAligned($time + $num + 1)) {
                return false;
            }
        }

        return true;
    }

}
