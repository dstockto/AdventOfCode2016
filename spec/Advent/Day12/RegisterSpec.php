<?php
declare(strict_types = 1);

namespace spec\Advent\Day12;

use Advent\Day12\Register;
use PhpSpec\ObjectBehavior;

class RegisterSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Register::class);
    }

    public function it_has_a_value_of_0_to_start()
    {
        $this->getValue()->shouldBe(0);
    }

    public function it_can_increase_by_one()
    {
        $this->incr();

        $this->getValue()->shouldBe(1);
        $this->incr();
        $this->getValue()->shouldBe(2);
    }

    public function it_can_decrease_by_one()
    {
        $this->dec();
        $this->getValue()->shouldBe(-1);
        $this->dec();
        $this->getValue()->shouldBe(-2);
    }

    public function it_can_be_set_to_a_value()
    {
        $this->setValue(42);
        $this->getValue()->shouldBe(42);
        $this->incr();
        $this->getValue()->shouldBe(43);
        $this->dec();
        $this->dec();
        $this->getValue()->shouldBe(41);
    }
}
