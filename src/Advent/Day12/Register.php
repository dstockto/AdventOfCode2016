<?php
declare(strict_types = 1);

namespace Advent\Day12;

class Register
{
    private $value;

    public function __construct()
    {
        $this->value = 0;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function incr()
    {
        $this->value++;
    }

    public function dec()
    {
        $this->value--;
    }

    public function setValue(int $value)
    {
        $this->value = $value;
    }
}
