<?php
declare(strict_types = 1);

namespace spec\Advent\Day11;

use Advent\Day11\Generator;
use Advent\Day11\Item;
use Advent\Day11\Microchip;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MicrochipSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('Thulium');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Microchip::class);
    }

    public function it_is_an_item()
    {
        $this->shouldHaveType(Item::class);
    }

    public function it_should_know_its_element()
    {
        $this->getElement()->shouldBe('Thulium');
    }

    public function it_should_know_its_type()
    {
        $this->getType()->shouldBe('Microchip');
    }

    public function it_knows_if_it_is_protected_by_a_generator(Generator $generator)
    {
        $generator->getElement()->willReturn('Thulium');
        $this->isProtectedBy($generator)->shouldBe(true);
    }

    public function it_knows_if_it_is_not_protected_by_a_generator(Generator $generator)
    {
        $generator->getElement()->willReturn('Strontium');
        $this->isProtectedBy($generator)->shouldBe(false);
    }
}
