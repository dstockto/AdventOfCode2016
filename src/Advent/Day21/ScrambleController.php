<?php
declare(strict_types = 1);

namespace Advent\Day21;

class ScrambleController
{
    public function __construct()
    {
        $this->scrambler = new Scrambler();
    }

    public function processInstructions(string $input, array $instructions): string
    {
        $output = $input;
        foreach ($instructions as $instruction) {
//            echo $output . ' - ' . trim($instruction) . ' --> ';
            $output = $this->parseInstruction($output, trim($instruction));
//            echo $output . "\n";
        }

        return $output;
    }

    private function parseInstruction(string $input, string $instruction): string
    {
        switch (true) {
            case preg_match('/swap position (?P<x>\d+) with position (?P<y>\d)/', $instruction, $matches):
                return $this->scrambler->swapPosition($input, $matches['x'], $matches['y']);
            case preg_match('/swap letter (?<x>[a-z]) with letter (?<y>[a-z])/', $instruction, $matches):
                return $this->scrambler->swapLetters($input, $matches['x'], $matches['y']);
            case preg_match('/rotate (?P<direction>left|right) (?P<steps>\d+) steps?/', $instruction, $matches):
                return $this->scrambler->rotateSteps($input, $matches['direction'], $matches['steps']);
            case preg_match('/move position (?P<x>\d+) to position (?P<y>\d+)/', $instruction, $matches):
                return $this->scrambler->movePosition($input, $matches['x'], $matches['y']);
            case preg_match('/rotate based on position of letter (?P<letter>[a-z])/', $instruction, $matches):
                return $this->scrambler->rotateLetter($input, $matches['letter']);
            case preg_match('/reverse positions (?P<x>\d+) through (?P<y>\d+)/', $instruction, $matches):
                return $this->scrambler->reverseBetween($input, $matches['x'], $matches['y']);
            default:
                return 'Bad Instruction: ' . $instruction . "\n";
        }
    }

    public function unscramble(string $input, array $instructions): string
    {
        $output = $input;

        foreach (array_reverse($instructions) as $instruction) {
            echo $input . ' <-- ' . trim($instruction) . ' -- ';
            $original = $output;
            $output = $this->parseInstructionReverse($output, trim($instruction));
            echo $output . "\n";
            assert($this->parseInstruction($output, $instruction) == $original, "Failure on $input with $instruction");
        }

        return $output;
    }

    private function parseInstructionReverse(string $input, string $instruction): string
    {
        switch (true) {
            case preg_match('/swap position (?P<x>\d+) with position (?P<y>\d)/', $instruction, $matches):
                return $this->scrambler->swapPosition($input, $matches['x'], $matches['y']);
            case preg_match('/swap letter (?<x>[a-z]) with letter (?<y>[a-z])/', $instruction, $matches):
                return $this->scrambler->swapLetters($input, $matches['x'], $matches['y']);
            case preg_match('/rotate (?P<direction>left|right) (?P<steps>\d+) steps?/', $instruction, $matches):
                $direction = $matches['direction'] === 'left' ? 'right' : 'left';
                return $this->scrambler->rotateSteps($input, $direction, $matches['steps']);
            case preg_match('/move position (?P<x>\d+) to position (?P<y>\d+)/', $instruction, $matches):
                return $this->scrambler->movePosition($input, $matches['y'], $matches['x']);
            case preg_match('/rotate based on position of letter (?P<letter>[a-z])/', $instruction, $matches):
                $steps = $this->getSteps(strpos($input, $matches['letter']));
                return $this->scrambler->rotateSteps($input, 'left', $steps);

                return $this->scrambler->rotateLetter($input, $matches['letter']);
                break;
            case preg_match('/reverse positions (?P<x>\d+) through (?P<y>\d+)/', $instruction, $matches):
                return $this->scrambler->reverseBetween($input, $matches['x'], $matches['y']);
            default:
                return "$input - Bad instruction $instruction";
        }
    }

    private function getSteps(int $strpos): int
    {
        $stepMap = [
            0 => 9,
            1 => 1,
            2 => 5,
            3 => 2,
            4 => 7,
            5 => 3,
            6 => 8,
            7 => 4,
        ];

        return $stepMap[$strpos];
    }
}
