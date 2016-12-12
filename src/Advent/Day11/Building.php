<?php
declare(strict_types = 1);

namespace Advent\Day11;

class Building
{
    /** @var int */
    private $elevatorFloor;
    /** @var int */
    private $buildingFloors;
    /** @var Floor[] */
    private $floors;

    public function __construct()
    {
        $this->elevatorFloor  = 1;
        $this->buildingFloors = 4;
        $this->floors         = [];

        for ($floorNum = 1; $floorNum <= $this->buildingFloors; $floorNum++) {
            $this->floors[$floorNum] = new Floor();
        }
    }

    public function getFloors(): int
    {
        return $this->buildingFloors;
    }

    public function getElevatorFloor(): int
    {
        return $this->elevatorFloor;
    }

    public function moveElevatorUp()
    {
        if ($this->elevatorFloor < $this->buildingFloors) {
            $this->elevatorFloor++;
            return;
        }

        throw new \RuntimeException('Cannot move up from top floor');
    }

    public function moveElevatorDown()
    {
        if ($this->elevatorFloor > 1) {
            $this->elevatorFloor--;
            return;
        }

        throw new \RuntimeException('Cannot move down from bottom floor');
    }

    public function storeItem(Item $item, int $floor)
    {
        if ($floor < 1) {
            throw new \RuntimeException('Cannot store item in basement');
        }
        if ($floor > $this->buildingFloors) {
            throw new \RuntimeException('Cannot store above roof');
        }

        $this->floors[$floor]->store($item);
    }

    public function getItemsOnFloor(int $floor): array
    {
        return $this->floors[$floor]->getItems();
    }

    public function isFloorSafe(int $floor): bool
    {
        return $this->floors[$floor]->isSafe();
    }
}
