<?php
declare(strict_types = 1);

namespace Advent\Day10;

interface ChipReceiver
{
    public function giveChip(Microchip $chip);
}
