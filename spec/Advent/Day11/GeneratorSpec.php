<?php
declare(strict_types = 1);

namespace spec\Advent\Day11;

use Advent\Day11\Generator;
use Advent\Day11\Item;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GeneratorSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('Strontium');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Generator::class);
    }

    public function it_is_an_item()
    {
        $this->shouldHaveType(Item::class);
    }

    public function it_should_know_its_element()
    {
        $this->getElement()->shouldBe('Strontium');
    }

    public function it_should_know_its_type()
    {
        $this->getType()->shouldBe('Generator');
    }
}
