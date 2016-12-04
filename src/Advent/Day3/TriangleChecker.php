<?php
declare(strict_types = 1);

namespace Advent\Day3;

class TriangleChecker
{
    public function validate($a, $b, $c): bool
    {
        return ($a < ($b + $c))
            && ($b < ($a + $c))
            && ($c < ($a + $b));
    }
}
