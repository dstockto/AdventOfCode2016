<?php
declare(strict_types = 1);

namespace Advent\Day1;

use Illuminate\Support\Collection;

/**
 * Combines a Direction object to keep track of which way we are facing along with a list of instructions indicating
 * which direction to turn and how many blocks to walk.
 *
 * @package Advent\Day1
 */
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

    /**
     * Runs through the directions provides and gives back the distance from the origin to the final destination in
     * terms of a single MovementVector.
     *
     * @return MovementVector
     */
    public function getDistance(): MovementVector
    {
        $start = $this->direction->getMovementVector(0);

        $result = $this->getMovementVectors()->reduce(function (MovementVector $result, MovementVector $new) {
            return $result->addVector($new);
        }, $start);

        return $result;
    }

    /**
     * The puzzle calls for a taxi distance which is the total number of blocks north or south plus the total number
     * of blocks east or west to travel if going from the origin straight to the destination instead of through the
     * convoluted and backtracking path the directions wanted us to follow.
     *
     * @return int
     */
    public function getTaxiDistance(): int
    {
        $vector = $this->getDistance();
        return (int) abs($vector->getXMovement()) + abs($vector->getYMovement());
    }

    public function getFirstVisitedTwiceDistance(): int
    {
        $directions = $this->getMovementVectors();

        $map = new Map();
        $location = new MovementVector(0, 0);
        $map->visit($location->getXMovement(), $location->getYMovement());

        /** @var MovementVector $vector */
        foreach ($directions as $vector) {
            foreach ($vector->getUnitMovements() as $direction) {
                $location = $location->addVector($direction);
                $visited = $map->visit($location->getXMovement(), $location->getYMovement());
                if ($visited) {
                    break 2;
                }
            }
        }
        return $location->getTaxiDistance();
    }

    protected function getMovementVectors(): Collection
    {
        if ($this->instructions === '') {
            return collect();
        }

        $result = collect(explode(',', $this->instructions) ?? [])->map(
            function (string $rotateDistance) {
                if (0 === preg_match('/(?<direction>R|L)(?P<distance>\d+)/', $rotateDistance, $matches)) {
                    return;
                }
                if ($matches['direction'] === 'R') {
                    $this->direction->turnRight();
                } elseif ($matches['direction'] === 'L') {
                    $this->direction->turnLeft();
                }

                return $this->direction->getMovementVector((int) $matches['distance']);
            }
        );

        return $result;
    }
}
