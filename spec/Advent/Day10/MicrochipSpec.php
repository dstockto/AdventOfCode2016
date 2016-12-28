<?php
declare(strict_types = 1);

namespace spec\Advent\Day10;

use Advent\Day10\Microchip;
use PhpSpec\ObjectBehavior;

class MicrochipSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(10);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Microchip::class);
    }

    public function it_can_store_a_value()
    {
        $this->getValue()->shouldBe(10);
    }
}
