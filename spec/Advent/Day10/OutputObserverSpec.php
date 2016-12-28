<?php
declare(strict_types = 1);

namespace spec\Advent\Day10;

use Advent\Day10\Microchip;
use Advent\Day10\OutputObserver;
use PhpSpec\ObjectBehavior;

class OutputObserverSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(OutputObserver::class);
    }

    public function it_can_capture_chip_ids(Microchip $chip, Microchip $chip2, Microchip $chip3)
    {
        $chip->getValue()->willReturn(7);
        $chip2->getValue()->willReturn(2);
        $chip3->getValue()->willReturn(3);

        $this($chip);
        $this($chip2);
        $this($chip3);

        $this->getChipIdProduct()->shouldBe(42);
    }
}
