<?php
declare(strict_types = 1);

namespace Advent\Day18;

class RogueMap
{
    const SAFE = '.';
    const TRAP = '^';

    public function __invoke(string $start)
    {
        while (true) {
            $start = $this->getLine($start);
            yield $start;
        }
    }

    private function getLine($line): string
    {
        $newLine = '';
        foreach (str_split($line) as $position => $item) {
            $left   = $line[$position - 1] ?? self::SAFE;
            $center = $line[$position];
            $right  = $line[$position + 1] ?? self::SAFE;

            $newChar = $this->getTrapOrSafeChar($left, $center, $right);
            $newLine .= $newChar;
        }

        return $newLine;
    }

    private function getTrapOrSafeChar(string $left, string $center, string $right): string
    {
        $surrounding = implode('', [$left, $center, $right]);

        $isTrapPatterns = [
            '^^.',
            '.^^',
            '^..',
            '..^'
        ];

        if (in_array($surrounding, $isTrapPatterns)) {
            return self::TRAP;
        }

        return self::SAFE;
    }
}
