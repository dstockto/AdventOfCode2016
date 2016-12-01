<?php
declare(strict_types = 1);

namespace Advent\Day1;

use Illuminate\Support\Collection;

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

        $result = $this->getMovementVectors()->reduce(function (MovementVector $result, MovementVector $new) {
            return $result->addVector($new);
        }, $start);

        return $result;
    }

    public function getTaxiDistance(): int
    {
        $vector = $this->getDistance();
        return $vector->getTaxiDistance();
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
        return collect(explode(',', $this->instructions))->map(
            function ($pair) {
                return trim($pair);
            }
        )->filter(function ($pair) {
            return $pair != '';
        })->map(function ($pair) {
            preg_match('/(?P<direction>L|R)(?P<distance>\d+)/', $pair, $matches);

            if ($matches['direction'] == 'L') {
                $this->direction->turnLeft();
            } else {
                if ($matches['direction'] == 'R') {
                    $this->direction->turnRight();
                }
            }

            return $this->direction->getMovementVector((int) $matches['distance']);
        });
    }
}
