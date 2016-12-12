<?php
declare(strict_types = 1);

namespace Advent\Day11;

class Microchip implements Item
{
    /**
     * @var string
     */
    private $element;

    public function __construct(string $element)
    {
        $this->element = $element;
    }

    public function getType(): string
    {
        return 'Microchip';
    }

    public function getElement(): string
    {
        return $this->element;
    }

    public function isProtectedBy(Generator $generator): bool
    {
        return $generator->getElement() === $this->element;
    }
}
