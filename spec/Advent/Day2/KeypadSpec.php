<?php
declare(strict_types = 1);

namespace spec\Advent\Day2;

use Advent\Day2\Keypad;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class KeypadSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Keypad::class);
    }

    function it_should_start_pointing_at_5()
    {
        $this->getCurrentKey()->shouldBe(5);
    }

    function it_should_have_a_normal_number_layout()
    {
        $this->getCurrentKey()->shouldBe(5);
        $this->moveUp();
        $this->getCurrentKey()->shouldBe(2);
        $this->moveLeft();
        $this->getCurrentKey()->shouldBe(1);
        $this->moveDown();
        $this->getCurrentKey()->shouldBe(4);
        $this->moveDown();
        $this->getCurrentKey()->shouldBe(7);
        $this->moveRight();
        $this->getCurrentKey()->shouldBe(8);
        $this->moveRight();
        $this->getCurrentKey()->shouldBe(9);
        $this->moveUp();
        $this->getCurrentKey()->shouldBe(6);
        $this->moveUp();
        $this->getCurrentKey()->shouldBe(3);
    }

    function it_will_not_move_off_the_edges()
    {
        $this->moveUp();
        $this->moveUp();
        $this->moveUp();
        $this->getCurrentKey()->shouldBe(2);
    }
}
