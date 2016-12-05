<?php
declare(strict_types = 1);

namespace Advent\Day5;

class PasswordGenerator
{
    public function solve($roomId)
    {
        $password = '';
        $index    = 0;

        while (strlen($password) < 8) {
            do {
                $md5 = md5($roomId . $index);
                $index++;
            } while (strpos($md5, '00000') !== 0);

            $password .= $md5[5];
        }

        return $password;
    }

    public function newSolve($roomId)
    {
        $password = [];
        $index    = 1;

        while (count($password) < 8) {
            do {
                $md5 = md5($roomId . $index);
                $index++;
            } while (strpos($md5, '00000') !== 0);

            $position  = $md5[5];
            $character = $md5[6];
            if (!is_numeric($position) || $position < 0 || $position > 7) {
                continue;
            }
            if (!isset($password[$position])) {
                $password[$position] = $character;
            }
        }

        ksort($password);
        return implode('', $password);
    }
}
