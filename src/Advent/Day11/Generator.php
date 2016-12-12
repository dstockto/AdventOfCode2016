<?php
declare(strict_types = 1);

namespace Advent\Day11;

class Generator implements Item
{
    /**
     * @var string
     */
    private $element;

    /**
     * Generator constructor.
     */
    public function __construct(string $element)
    {
        $this->element = $element;
    }

    public function getType(): string
    {
        return 'Generator';
    }

    public function getElement(): string
    {
        return $this->element;
    }
}
