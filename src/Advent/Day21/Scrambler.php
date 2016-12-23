<?php
declare(strict_types = 1);

namespace Advent\Day21;

class Scrambler
{
    public function swapPosition(string $input, int $x, int $y): string
    {
        list($input[$x], $input[$y]) = [$input[$y], $input[$x]];

        return $input;
    }

    public function swapLetters(string $input, string $letterX, string $letterY): string
    {
        $letterXPos = strpos($input, $letterX);
        $letterYPos = strpos($input, $letterY);

        return $this->swapPosition($input, $letterXPos, $letterYPos);
    }

    public function rotateSteps(string $input, string $direction, int $steps): string
    {
        if ($steps === 0) {
            return $input;
        }

        switch ($direction) {
            case 'right':
                $output = substr($input, -1) . substr($input, 0, -1);
                return $this->rotateSteps($output, $direction, $steps - 1);
                break;
            case 'left':
                $output = substr($input, 1) . $input[0];
                return $this->rotateSteps($output, $direction, $steps - 1);
                break;
            default:
                return $input;
        }
    }

    public function rotateLetter(string $input, string $letter): string
    {
        $letterPos = strpos($input, $letter);
        $steps     = $letterPos + 1;
        if ($letterPos >= 4) {
            $steps++;
        }

        return $this->rotateSteps($input, 'right', $steps);
    }

    public function reverseBetween(string $input, int $x, int $y): string
    {
        $start  = substr($input, 0, $x);
        $middle = substr($input, $x, $y - $x + 1);
        $end    = substr($input, $y + 1);
        $middle = strrev($middle);

        return $start . $middle . $end;
    }

    public function movePosition(string $input, int $x, int $y): string
    {
        // Get the letter
        $letter = $input[$x];
        // Remove it
        $input = str_replace($letter, '', $input);

        // Put it in spot $y
        $start = substr($input, 0, $y);
        $end = substr($input, $y);
        $output = $start . $letter . $end;

        return $output;
    }
}
