<?php
declare(strict_types = 1);

namespace spec\Advent\Day8;

use Advent\Day8\Grid;
use PhpSpec\ObjectBehavior;

class GridSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(7, 3);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Grid::class);
    }

    public function it_can_show_its_state_as_a_string()
    {
        $this->__toString()->shouldBe(
            ".......\n" .
            ".......\n" .
            ".......\n"
        );
    }

    public function it_can_turn_on_a_rectangle_at_the_top_left()
    {
        $this->rect(3, 2);
        $this->__toString()->shouldBe(
            "###....\n" .
            "###....\n" .
            ".......\n"
        );
    }

    public function it_can_rotate_columns()
    {
        $this->rect(3, 2);
        $this->rotateColumn(1, 1);
        $this->__toString()->shouldBe(
            "#.#....\n" .
            "###....\n" .
            ".#.....\n"
        );
    }

    public function it_can_rotate_rows()
    {
        $this->rect(3, 2);
        $this->rotateColumn(1, 1);
        $this->rotateRow(0, 4);
        $this->__toString()->shouldBe(
            "....#.#\n" .
            "###....\n" .
            ".#.....\n"
        );
    }

    public function it_can_wrap_rotations()
    {
        $this->rect(3, 2);
        $this->rotateColumn(1, 1);
        $this->rotateRow(0, 4);
        $this->rotateColumn(1, 1);
        $this->__toString()->shouldBe(
            ".#..#.#\n" .
            "#.#....\n" .
            ".#.....\n"
        );
    }

    public function it_can_determine_how_many_parts_are_on()
    {
        $this->rect(1, 1);
        $this->getLitCount()->shouldBe(1);
        $this->rect(3, 2);
        $this->getLitCount()->shouldBe(6);
        $this->rotateColumn(0, 1);
        $this->rect(1, 1);
        $this->getLitCount()->shouldBe(7);
    }
}
