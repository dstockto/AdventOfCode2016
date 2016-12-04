<?php
declare(strict_types = 1);

namespace Advent\Day2;

class ExecutiveKeypad
{
    private $startingPosition;
    private $keypad;

    public function __construct(array $keypadLayout, array $startingPosition)
    {
        $this->startingPosition = $startingPosition;

        $this->keypad = [];
        foreach ($keypadLayout as $number => $line) {
            $keys = str_split($line);
            foreach ($keys as $x => $character) {
                if ($character == ' ') {
                    continue;
                }
                $this->keypad[$x][$number] = $character;
            }
        }
    }

    public function getCurrentKey(): string
    {
        list ($x, $y) = $this->startingPosition;
        return $this->keypad[$x][$y];
    }

    public function moveUp()
    {
        list($x, $y) = $this->startingPosition;

        if (isset($this->keypad[$x][$y - 1])) {
            $y--;
            $this->startingPosition = [$x, $y];
        }

    }

    public function moveLeft()
    {
        list($x, $y) = $this->startingPosition;

        if (isset($this->keypad[$x - 1][$y])) {
            $x--;
            $this->startingPosition = [$x, $y];
        }

    }

    public function moveDown()
    {
        list($x, $y) = $this->startingPosition;

        if (isset($this->keypad[$x][$y + 1])) {
            $y++;
            $this->startingPosition = [$x, $y];
        }

    }

    public function moveRight()
    {
        list($x, $y) = $this->startingPosition;

        if (isset($this->keypad[$x + 1][$y])) {
            $x++;
            $this->startingPosition = [$x, $y];
        }
    }
}
