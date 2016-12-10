<?php
declare(strict_types = 1);

namespace spec\Advent\Day10;

use Advent\Day10\ChipReceiver;
use Advent\Day10\Microchip;
use Advent\Day10\OutputBin;
use Advent\Day10\OutputObserver;
use PhpSpec\ObjectBehavior;

class OutputBinSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(75);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(OutputBin::class);
        $this->shouldHaveType(ChipReceiver::class);
    }

    public function it_knows_its_number()
    {
        $this->getNumber()->shouldBe(75);
    }

    public function it_can_store_chips(Microchip $chip1, Microchip $chip2)
    {
        $chip1->getValue()->willReturn(42);
        $chip2->getValue()->willReturn(72);

        $this->giveChip($chip1);

        $this->hasChip(42)->shouldBe(true);
        $this->hasChip(72)->shouldBe(false);

        $this->giveChip($chip2);
        $this->hasChip(42)->shouldBe(true);
        $this->hasChip(72)->shouldBe(true);

        $this->getChips()->shouldBe([42 => $chip1, 72 => $chip2]);
    }

    public function it_can_be_observed(OutputObserver $observer, Microchip $chip1, Microchip $chip2, Microchip $chip3)
    {
        $this->addObserver($observer);
        $chip1->getValue()->willReturn(10);
        $chip2->getValue()->willReturn(5);
        $chip3->getValue()->willReturn(2);

        $observer->__invoke($chip1)->shouldBeCalled();
        $observer->__invoke($chip2)->shouldBeCalled();
        $observer->__invoke($chip3)->shouldBeCalled();

        $this->giveChip($chip1);
        $this->giveChip($chip2);
        $this->giveChip($chip3);
    }
}
