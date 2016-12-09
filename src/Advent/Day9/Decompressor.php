<?php
declare(strict_types = 1);

namespace Advent\Day9;

class Decompressor
{
    public function decompress(string $input): string
    {
        $output = '';

        $inputLength = strlen($input);
        for ($index = 0; $index < $inputLength; $index++) {
            $letter = $input[$index];
            if ($letter !== '(') {
                $output .= $letter;
                continue;
            }

            $marker = $this->findMarker(substr($input, $index));

            $capture  = substr($input, $index + $marker->getMarkerLength(), $marker->getSize());
            $repeated = str_repeat($capture, $marker->getRepeat());
            $output .= $repeated;
            $index += $marker->getMarkerLength() + $marker->getSize() - 1;
        }

        return $output;
    }

    private function findMarker(string $input): Marker
    {
        $count = preg_match('/^(\(\d+x\d+\))/', $input, $matches);

        if ($count == 0) {
            throw new \RuntimeException('Found a bogus marker in ' . $input);
        }
        return new Marker($matches[1]);
    }

    public function decompressV2(string $input): int
    {
        $length = 0;
        $i      = 0;

        while ($i < strlen($input)) {
            if ($input[$i] !== '(') {
                $length++;
                $i++;
                continue;
            }
            $marker        = $this->findMarker(substr($input, $i));
            $end           = $i + $marker->getMarkerLength() + $marker->getSize();

            // Repeat the expansion of the captured group (recursively)
            $sectionLength = $marker->getRepeat() *
                $this->decompressV2(
                    substr($input, $i + $marker->getMarkerLength(), $marker->getSize())
                );
            $length += $sectionLength;
            // Move past the chunk captured by the capture specifier
            $i = $end;
        }

        return $length;
    }
}
