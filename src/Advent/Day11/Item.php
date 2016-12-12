<?php
declare(strict_types = 1);

namespace Advent\Day11;

interface Item
{
    public function getType(): string;
    public function getElement(): string;
}
