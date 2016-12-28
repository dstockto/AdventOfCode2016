<?php
declare(strict_types = 1);

namespace Advent\Day8;

class CommandParser
{
    /**
     * @var Grid
     */
    private $grid;

    public function __construct(Grid $grid)
    {
        $this->grid = $grid;
    }

    public function parse(string $command)
    {
        $parts     = explode(' ', $command, 2);
        $verb      = $parts[0];
        $arguments = $parts[1];

        switch ($verb) {
            case 'rect':
                list ($width, $height) = $this->parseRectArgs($arguments);
                $this->grid->rect($width, $height);
                break;
            case 'rotate':
                list ($command, $coordinate, $number) = $this->parseRotateArgument($arguments);
                $this->grid->$command($coordinate, $number);
                break;
            default:
                throw new \RuntimeException('Unable to parse: ' . $command);
        }
    }

    private function parseRectArgs(string $arguments): array
    {
        $parts = explode('x', $arguments);

        return [(int)$parts[0], (int)$parts[1]];
    }

    private function parseRotateArgument(string $arguments)
    {
        preg_match('/(?P<direction>row|column) (?:y|x)=(?P<coordinate>\d+) by (?P<amount>\d+)/', $arguments, $matches);

        $direction  = 'rotate' . ucfirst($matches['direction']);
        $coordinate = (int)$matches['coordinate'];
        $amount     = (int)$matches['amount'];

        return [$direction, $coordinate, $amount];
    }
}
