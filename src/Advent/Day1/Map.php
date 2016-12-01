<?php
declare (strict_types=1);

namespace Advent\Day1;

class Map
{
    private $marker;

    public function visit(int $x, int $y): bool
    {
        $visited = $this->didVisit($x, $y);
        $this->marker["$x-$y"] = true;

        return $visited;
    }

    public function didVisit(int $x, int $y): bool
    {
        return isset($this->marker["$x-$y"]);
    }
}
