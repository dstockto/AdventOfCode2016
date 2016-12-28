<?php
declare(strict_types = 1);

namespace Advent\Day16;

class DragonCurver
{
    public function curve(string $a): string
    {
        $b = strrev($a);
        $b = str_replace(['0', '1', 'l'], ['l', '0', '1'], $b);

        return $a . '0' . $b;
    }

    public function checksum(string $curve): string
    {
        $checkSum = '';
        foreach (str_split($curve, 2) as $pair) {
            if ($pair[0] === $pair[1]) {
                $checkSum .= '1';
            } else {
                $checkSum .= '0';
            }
        }

        if (strlen($checkSum) % 2 === 0) {
            return $this->checksum($checkSum);
        }
        return $checkSum;
    }
}
