<?php
declare(strict_types = 1);

namespace Advent\Day10;

class Microchip
{
    private $value;

    /**
     * Microchip constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}
