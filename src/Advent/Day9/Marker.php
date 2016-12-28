<?php
declare(strict_types = 1);

namespace Advent\Day9;

class Marker
{
    public function __construct($marker)
    {
        $interior = trim($marker, '()');
        list($size, $repeat) = explode('x', $interior);
        $this->size   = (int)$size;
        $this->repeat = (int)$repeat;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getRepeat(): int
    {
        return $this->repeat;
    }

    public function getMarkerLength(): int
    {
        return strlen((string)$this);
    }

    public function __toString(): string
    {
        return sprintf('(%dx%d)', $this->size, $this->repeat);
    }
}
