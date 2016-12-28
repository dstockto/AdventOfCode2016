<?php
declare(strict_types = 1);

namespace Advent\Day2;

class PasscodeDecoder
{
    private $digitInstructions = [];

    public function __construct($passcode)
    {
        $this->digitInstructions = explode("\n", $passcode);
    }

    public function getBathroomCode(): string
    {
        $keypad = new ExecutiveKeypad(
            [
                '123',
                '456',
                '789',
            ],
            [1, 1]
        );
        return $this->tryBathroomInstructions($keypad);
    }

    public function getExecutiveBathroomCode(): string
    {
        $keypad = new ExecutiveKeypad(
            ['  1  ',
             ' 234 ',
             '56789',
             ' ABC ',
             '  D  '],
            [0, 2]
        );
        return $this->tryBathroomInstructions($keypad);
    }

    /**
     * @param $keypad
     * @return string
     */
    public function tryBathroomInstructions($keypad): string
    {
        $digits = [];

        foreach ($this->digitInstructions as $line) {
            $instructions = str_split($line);
            foreach ($instructions as $instruction) {
                switch ($instruction) {
                    case 'U':
                        $keypad->moveUp();
                        break;
                    case 'D':
                        $keypad->moveDown();
                        break;
                    case 'R':
                        $keypad->moveRight();
                        break;
                    case 'L':
                        $keypad->moveLeft();
                        break;
                }
            }
            $digits[] = $keypad->getCurrentKey();
        }

        return join('', $digits);
    }
}
