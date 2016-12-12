<?php
declare(strict_types = 1);

namespace spec\Advent\Day11;

use Advent\Day11\Building;
use Advent\Day11\Generator;
use Advent\Day11\Item;
use Advent\Day11\Microchip;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BuildingSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Building::class);
    }

    public function it_has_4_floors()
    {
        $this->getFloors()->shouldBe(4);
    }

    public function it_has_an_elevator_which_can_move_through_floors()
    {
        $this->getElevatorFloor()->shouldBe(1);
        $this->moveElevatorUp();
        $this->getElevatorFloor()->shouldBe(2);
        $this->moveElevatorUp();
        $this->getElevatorFloor()->shouldBe(3);
        $this->moveElevatorUp();
        $this->getElevatorFloor()->shouldBe(4);
        $this->shouldThrow(new \RuntimeException('Cannot move up from top floor'))->during('moveElevatorUp');
        $this->moveElevatorDown();
        $this->getElevatorFloor()->shouldBe(3);
        $this->moveElevatorDown();
        $this->getElevatorFloor()->shouldBe(2);
        $this->moveElevatorDown();
        $this->getElevatorFloor()->shouldBe(1);
        $this->shouldThrow(new \RuntimeException('Cannot move down from bottom floor'))->during('moveElevatorDown');
    }

    public function it_can_store_items_on_floors(Item $item, Item $item2, Item $item3)
    {
        $this->storeItem($item, 1);
        $this->getItemsOnFloor(1)->shouldBe([$item]);
        $this->getItemsOnFloor(2)->shouldBe([]);
        $this->getItemsOnFloor(3)->shouldBe([]);
        $this->getItemsOnFloor(4)->shouldBe([]);
        $this->storeItem($item2, 2);
        $this->getItemsOnFloor(2)->shouldBe([$item2]);
        $this->storeItem($item3, 2);
        $this->getItemsOnFloor(2)->shouldBe([$item2, $item3]);
    }

    public function it_cannot_store_an_item_in_the_basement(Item $item)
    {
        $this->shouldThrow(new \RuntimeException('Cannot store item in basement'))->during('storeItem', [$item, 0]);
    }

    public function it_cannot_store_an_item_above_the_top_floor(Item $item)
    {
        $this->shouldThrow(new \RuntimeException('Cannot store above roof'))->during('storeItem', [$item, 5]);
    }

    public function it_knows_a_floor_is_safe_if_it_is_empty()
    {
        $this->isFloorSafe(1)->shouldBe(true);
        $this->isFloorSafe(2)->shouldBe(true);
        $this->isFloorSafe(3)->shouldBe(true);
        $this->isFloorSafe(4)->shouldBe(true);
    }

    public function it_knows_a_floor_is_safe_if_it_only_contains_microchips(Microchip $chip1, Microchip $chip2)
    {
        $this->storeItem($chip1, 2);
        $this->storeItem($chip2, 2);

        $this->isFloorSafe(2)->shouldBe(true);
    }

    public function it_knows_a_floor_is_safe_if_it_only_contains_generators(Generator $gen1, Generator $gen2)
    {
        $this->storeItem($gen1, 1);
        $this->storeItem($gen2, 1);

        $this->isFloorSafe(1)->shouldBe(true);
    }

    public function it_knows_a_floor_is_safe_if_it_contains_a_paired_chip_and_generator(
        Generator $gen1,
        Microchip $chip1
    ) {
        $gen1->getElement()->willReturn('Radium');
        $chip1->getElement()->willReturn('Radium');

        $this->storeItem($gen1, 3);
        $this->storeItem($chip1, 3);

        $this->isFloorSafe(3)->shouldBe(true);
    }

    public function it_knows_a_floor_is_safe_if_all_microchips_are_paired(
        Generator $gen1,
        Generator $gen2,
        Generator $gen3,
        Microchip $chip1,
        Microchip $chip2
    ) {
        $gen1->getElement()->willReturn('a');
        $chip1->getElement()->willReturn('a');

        $gen2->getElement()->willReturn('b');
        $chip2->getElement()->willReturn('b');

        $gen3->getElement()->willReturn('C');

        $this->storeItem($gen1, 4);
        $this->storeItem($gen2, 4);
        $this->storeItem($chip1, 4);
        $this->storeItem($chip2, 4);
        $this->storeItem($gen3, 4);

        $this->isFloorSafe(4)->shouldBe(true);
    }

    public function it_knows_a_floor_is_not_safe_if_it_has_an_unpaired_chip_and_generator(
        Generator $gen1,
        Microchip $chip2
    ) {
        $gen1->getElement()->willReturn('Uranium');
        $chip2->getElement()->willReturn('Unobtanium');

        $this->storeItem($gen1, 2);
        $this->storeItem($chip2, 2);
        $this->isFloorSafe(2)->shouldBe(false);
    }
}
