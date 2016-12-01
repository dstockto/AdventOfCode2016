<?php

namespace Advent\Day1;

class Document
{

    /**
     * @var string
     */
    private $instructions;

    public function __construct(string $instructions = '')
    {
        $this->direction = new Direction('north');
        $this->instructions = $instructions;
    }

    public function getDistance(): MovementVector
    {
        $start = $this->direction->getMovementVector(0);

        $directions = collect(explode(',', $this->instructions));
        $result = $directions->map(
            function ($pair) {
                return trim($pair);
            }
        )->filter(function ($pair) {
            return $pair != '';
        })->map(function ($pair) {
            preg_match('/(?P<direction>L|R)(?P<distance>\d+)/', $pair, $matches);

            if ($matches['direction'] == 'L') {
                $this->direction->turnLeft();
            } else if ($matches['direction'] == 'R') {
                $this->direction->turnRight();
            }

            return $this->direction->getMovementVector($matches['distance']);
        })->reduce(function (MovementVector $result, MovementVector $new) {
            return $result->addVector($new);
        }, $start);

        return $result;
    }

    public function getTaxiDistance(): int
    {
        $vector = $this->getDistance();
        return abs($vector->getXMovement()) + abs($vector->getYMovement());
    }
}
