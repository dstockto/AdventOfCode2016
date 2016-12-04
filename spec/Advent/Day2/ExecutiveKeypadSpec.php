<?php
declare(strict_types = 1);

namespace spec\Advent\Day2;

use Advent\Day2\ExecutiveKeypad;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ExecutiveKeypadSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
             ['  1  ',
              ' 234 ',
              '56789',
              ' ABC ',
              '  D  '],
             [0, 2]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ExecutiveKeypad::class);
    }

    function it_should_start_on_5()
    {
        $this->getCurrentKey()->shouldBe("5");
    }

    function it_cannot_move_left_or_up_or_down_from_5()
    {
        $this->moveUp();
        $this->getCurrentKey()->shouldBe("5");
        $this->moveLeft();
        $this->getCurrentKey()->shouldBe("5");
        $this->moveDown();
        $this->getCurrentKey()->shouldBe("5");
    }

    function it_can_move_right_from_5()
    {
        $this->moveRight();
        $this->getCurrentKey()->shouldBe("6");
    }

    function it_will_get_5_for_up_left_left()
    {
        $this->moveUp();
        $this->moveUp();
        $this->moveLeft();
        $this->getCurrentKey()->shouldBe('5');
    }

    function it_will_get_D_for_RRDDD()
    {
        $this->moveRight();
        $this->moveRight();
        $this->moveDown();
        $this->moveDown();
        $this->moveDown();
        $this->getCurrentKey()->shouldBe('D');
    }

    function it_will_get_B_for_LURDL_when_start_with_D()
    {
        $this->beConstructedWith(
            [
                '  1  ',
                ' 234 ',
                '56789',
                ' ABC ',
                '  D  ',
            ],
            [2, 4]
        );
        $this->getCurrentKey()->shouldBe('D');

        $this->moveLeft();
        $this->moveUp();
        $this->moveRight();
        $this->moveDown();
        $this->moveLeft();
        $this->getCurrentKey()->shouldBe('B');
    }

    function it_will_be_3_with_UUUUD_when_starting_on_B()
    {
        $this->beConstructedWith(
            [
                '  1  ',
                ' 234 ',
                '56789',
                ' ABC ',
                '  D  ',
            ],
            [2, 3]
        );
        $this->getCurrentKey()->shouldBe('B');

        $this->moveUp();
        $this->moveUp();
        $this->moveUp();
        $this->moveUp();
        $this->moveDown();

        $this->getCurrentKey()->shouldBe('3');
    }
}
