<?php
declare(strict_types = 1);

namespace Advent\Day13;

class MazeGen
{
    /**
     * @var int
     */
    private $favoriteNumber;

    public function __construct(int $favoriteNumber)
    {
        $this->favoriteNumber = $favoriteNumber;
    }

    public function isWall(int $x, int $y): bool
    {
//        x*x + 3*x + 2*x*y + y + y*y
        $number = $x * $x + 3 * $x + 2 * $x * $y + $y + $y * $y;
        $number += $this->favoriteNumber;
        $string = decbin($number);
        $ones = preg_match_all('#1#', $string);
        return $ones % 2 == 1;
    }

    public function getMazePiece(int $minX, int $minY, int $maxX, int $maxY): string
    {
        $output = '';
        $output .= '  ' . implode('', range($minX, $maxX)) . "\n";
        for ($y = $minY; $y <= $maxY; $y++) {
            $output .= $y . ' ';
            for ($x = $minX; $x <= $maxX; $x++) {
                $output .= $this->isWall($x, $y) ? '#' : '.';
            }
            $output .= "\n";
        }
        return $output;
    }
}
