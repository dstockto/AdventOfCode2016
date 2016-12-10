<?php
declare(strict_types = 1);

namespace Advent\Day10;

class OutputObserver
{
    private $values = [];

    public function getChipIdProduct()
    {
        return array_reduce(
            $this->values,
            function ($carry, $value) {
                return $carry * $value;
            },
            1
        );
    }

    public function __invoke(Microchip $chip)
    {
        $this->values[] = $chip->getValue();
    }
}
