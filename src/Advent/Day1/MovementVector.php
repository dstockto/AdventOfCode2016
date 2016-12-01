<?php
declare(strict_types = 1);

namespace Advent\Day1;

/**
 * A combination of X and Y distance. Vectors can be added to other MovementVector or multiplied to represent
 * multiple movements in the same direction.
 *
 * @package Advent\Day1
 */
class MovementVector
{
    private $xMovement;
    private $yMovement;

    public function __construct(int $xMovement, int $yMovement)
    {
        $this->xMovement = $xMovement;
        $this->yMovement = $yMovement;
    }

    /**
     * Returns the number of movements to make in the X direction (positive or negative)
     * @return int
     */
    public function getXMovement(): int
    {
        return $this->xMovement;
    }

    /**
     * Returns the number of movements to make in the Y direction (positive or negative)
     * @return int
     */
    public function getYMovement(): int
    {
        return $this->yMovement;
    }

    /**
     * Adds another MovementVector to this one and returns a new MovementVector with the result.
     *
     * @param MovementVector $vector Vector to add
     *
     * @return MovementVector
     */
    public function addVector(MovementVector $vector): MovementVector
    {
        return new self($this->xMovement + $vector->getXMovement(), $this->yMovement + $vector->getYMovement());
    }

    /**
     * Creates a vector in the same direction, but one that is $multipler times longer
     *
     * @param int $multipler
     *
     * @return MovementVector
     */
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
