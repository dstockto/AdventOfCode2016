<?php
declare(strict_types = 1);

namespace Advent\Day2;

class Keypad
{
    private $currentKey = 5;

    public function getCurrentKey(): int
    {
        return $this->currentKey;
    }

    public function moveUp()
    {
        if (!in_array($this->currentKey, [1, 2, 3])) {
            $this->currentKey -= 3;
        }
    }

    public function moveLeft()
    {
        if (!in_array($this->currentKey, [1, 4, 7])) {
            $this->currentKey--;
        }
    }

    public function moveDown()
    {
        if (!in_array($this->currentKey, [7, 8, 9])) {
            $this->currentKey += 3;
        }
    }

    public function moveRight()
    {
        if (!in_array($this->currentKey, [3, 6, 9])) {
            $this->currentKey++;
        }
    }
}
