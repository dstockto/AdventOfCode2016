<?php
declare(strict_types = 1);

namespace Advent\Day1;

/**
 * Direction represents a cardinal direction. It essentially can be north, south, east or west. It can return a
 * MovementVector which represents the X and Y values for direction in any integer length. The direction this is
 * facing is allows turning to the left and right which will change the direction it is facing.
 *
 * @package Advent\Day1
 */
class Direction
{
    /** @var int */
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

    /**
     * Retrieve the currect direction it is facing
     *
     * @return string
     */
    public function getDirection(): string
    {
        return $this->directions[$this->direction];
    }

    /**
     * Rotate 90 degrees to the left (change the direction it is facing)
     */
    public function turnLeft()
    {
        $this->direction += 3;
        $this->direction %= 4;
    }

    /**
     * Rotate 90 degress to the right (change the direction it is facing)
     */
    public function turnRight()
    {
        ++$this->direction;
        $this->direction %= 4;
    }

    /**
     * Retrieve a movement vector which represents the number of grid spaces to move in the X or Y direction. The
     * distance argument is a multipllier
     *
     * @param int $distance Distance to move in the direction it is facing
     *
     * @return MovementVector
     */
    public function getMovementVector(int $distance): MovementVector
    {
        return ($this->getUnitVector())->getMultipliedVector($distance);
    }

    private function getUnitVector(): MovementVector
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
