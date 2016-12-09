<?php
declare(strict_types = 1);

namespace Advent\Day8;

class Grid
{
    private $pixels = [];
    private $width;
    private $height;

    public function __construct(int $width, int $height)
    {
        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $this->pixels[$x][$y] = '.';
            }
        }
        $this->width  = $width;
        $this->height = $height;
    }

    public function __toString(): string
    {
        $output = '';
        for ($y = 0; $y < $this->height; $y++) {
            for ($x = 0; $x < $this->width; $x++) {
                $output .= $this->pixels[$x][$y];
            }
            $output .= "\n";
        }

        return $output;
    }

    public function rect(int $width, int $height)
    {
        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $this->pixels[$x][$y] = '#';
            }
        }
    }

    public function rotateColumn(int $column, int $amount)
    {
        if ($amount == 0) {
            return;
        }

        $bottom = $this->pixels[$column][$this->height - 1];
        for ($y = $this->height - 1; $y > 0; $y--) {
            $this->pixels[$column][$y] = $this->pixels[$column][$y - 1];
        }
        $this->pixels[$column][0] = $bottom;

        $this->rotateColumn($column, $amount - 1);
    }

    public function rotateRow(int $row, int $amount)
    {
        if ($amount == 0) {
            return;
        }

        $right = $this->pixels[$this->width - 1][$row];
        for ($x = $this->width - 1; $x > 0; $x--) {
            $this->pixels[$x][$row] = $this->pixels[$x - 1][$row];
        }
        $this->pixels[0][$row] = $right;

        $this->rotateRow($row, $amount - 1);
    }

    public function getLitCount(): int
    {
        $lit = 0;
        for ($x = 0; $x < $this->width; $x++) {
            for ($y = 0; $y < $this->height; $y++) {
                if ($this->pixels[$x][$y] == '#') {
                    $lit++;
                }
            }
        }

        return $lit;
    }

}
