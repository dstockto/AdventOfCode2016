<?php
declare(strict_types = 1);

namespace Advent\Day1;

class MovementVector
{
    private $xMovement;
    private $yMovement;

    public function __construct(int $xMovement, int $yMovement)
    {
        $this->xMovement = $xMovement;
        $this->yMovement = $yMovement;
    }

    public function getXMovement(): int
    {
        return $this->xMovement;
    }

    public function getYMovement(): int
    {
        return $this->yMovement;
    }

    public function addVector(MovementVector $vector): MovementVector
    {
        return new self($this->xMovement + $vector->getXMovement(), $this->yMovement + $vector->getYMovement());
    }

    public function getMultipliedVector(int $multipler): MovementVector
    {
        return new self($multipler * $this->xMovement, $multipler * $this->yMovement);
    }

    public function getTaxiDistance(): int
    {
        return (int) (abs($this->xMovement) + abs($this->yMovement));
    }

    /**
     * @return MovementVector[]
     */
    public function getUnitMovements(): array
    {
        $vectors = [];

        for ($i = 0; $i < abs($this->xMovement); $i++) {
            $vectors[] = $this->xMovement > 0 ? new self(1, 0) : new self(-1, 0);
        }

        for ($i = 0; $i < abs($this->yMovement); $i++) {
            $vectors[] = $this->yMovement > 0 ? new self(0, 1) : new self(0, -1);
        }
        return $vectors;
    }
}
