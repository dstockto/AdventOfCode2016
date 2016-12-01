<?php

namespace Advent\Day1;

class Direction
{
    private $direction;

    private $directions = [
        'north',
        'east',
        'south',
        'west',
    ];

    public function __construct(string $direction = 'north')
    {
        $this->direction = array_search($direction, $this->directions);
        if ($this->direction === false) {
            throw new InvalidDirection('Unrecognized direction');
        }
    }

    public function getDirection(): string
    {
        return $this->directions[$this->direction];
    }

    public function turnLeft()
    {
        $this->direction += 3;
        $this->direction %= 4;
    }

    public function turnRight()
    {
        $this->direction += 1;
        $this->direction %= 4;
    }

    public function getMovementVector(int $distance): MovementVector
    {
        return ($this->getUnitVector())->getMultipliedVector($distance);
    }

    private function getUnitVector()
    {
        $vectors = [
            'north' => new MovementVector(0, 1),
            'east'  => new MovementVector(1, 0),
            'south' => new MovementVector(0, -1),
            'west'  => new MovementVector(-1, 0),
        ];

        return $vectors[$this->getDirection()];
    }
}
