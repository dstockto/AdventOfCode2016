<?php

namespace spec\Advent\Day11;

use Advent\Day11\Floor;
use Advent\Day11\Generator;
use Advent\Day11\Item;
use Advent\Day11\Microchip;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FloorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Floor::class);
    }

    public function it_can_store_items(Item $item1, Item $item2)
    {
        $this->getItems()->shouldBe([]);
        $this->store($item1);
        $this->getItems()->shouldBe([$item1]);
        $this->store($item2);
        $this->getItems()->shouldBe([$item1, $item2]);
    }

    public function it_is_safe_if_empty()
    {
        $this->isSafe()->shouldBe(true);
    }

    public function it_is_safe_if_all_items_are_microchips(Microchip $chip1, Microchip $chip2)
    {
        $this->store($chip1);
        $this->store($chip2);

        $this->isSafe()->shouldBe(true);
    }

    public function it_is_safe_if_all_items_are_generators(Generator $generator1, Generator $generator2)
    {
        $this->store($generator1);
        $this->store($generator2);

        $this->isSafe()->shouldBe(true);
    }

    public function it_is_safe_if_all_microchips_have_pairs_with_generators(
        Generator $g1,
        Microchip $c1,
        Generator $g2,
        Microchip $c2
    ) {
        $g1->getElement()->willReturn('a');
        $c1->getElement()->willReturn('a');

        $g2->getElement()->willReturn('b');
        $c2->getElement()->willReturn('b');

        $this->store($g1);
        $this->store($c1);
        $this->store($c2);
        $this->store($g2);

        $this->isSafe()->shouldBe(true);
    }

    public function it_is_not_safe_if_microchips_are_not_paired(Microchip $c1, Generator $g1, Microchip $c2)
    {
        $c1->getElement()->willReturn('a');
        $g1->getElement()->willReturn('a');
        $c2->getElement()->willReturn('b');

        $this->store($c1);
        $this->store($g1);
        $this->store($c2);

        $this->isSafe()->shouldBe(false);
    }

    public function it_can_represent_itself_with_a_state_string()
    {
        
    }
}
