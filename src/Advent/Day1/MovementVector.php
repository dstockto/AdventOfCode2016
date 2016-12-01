<?php

namespace Advent\Day1;

class MovementVector
{
    private $xMovement;
    private $yMovement;

    public function __construct($xMovement, $yMovement)
    {
        $this->xMovement = $xMovement;
        $this->yMovement = $yMovement;
    }

    public function getXMovement()
    {
        return $this->xMovement;
    }

    public function getYMovement()
    {
        return $this->yMovement;
    }

    public function addVector(MovementVector $vector)
    {
        return new self($this->xMovement + $vector->getXMovement(), $this->yMovement + $vector->getYMovement());
    }

    public function getMultipliedVector(int $multipler): MovementVector
    {
        return new self($multipler * $this->xMovement, $multipler * $this->yMovement);
    }
}
