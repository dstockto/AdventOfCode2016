<?php

namespace Advent\Day11;

class Floor
{
    private $contents = [];

    public function getItems(): array
    {
        return $this->contents;
    }

    public function store(Item $item)
    {
        $this->contents[] = $item;
    }

    public function isSafe(): bool
    {
        $stuff = collect($this->contents);
        $chips = $stuff->filter(
            function ($item) {
                return $item instanceof Microchip;
            }
        );
        $generators = $stuff->filter(
            function ($item) {
                return $item instanceof Generator;
            }
        );

        if ($chips->isEmpty() || $generators->isEmpty()) {
            return true;
        }

        // Check for pairs
        $generatorElements = $generators->map(
            function (Generator $generator) {
                return $generator->getElement();
            }
        );

        $unpairedChips = $chips->reject(
            function (Microchip $microchip) use ($generatorElements) {
                return $generatorElements->contains($microchip->getElement());
            }
        );

        return $unpairedChips->isEmpty();
    }


}
