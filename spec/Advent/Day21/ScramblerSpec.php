<?php
declare(strict_types = 1);

namespace spec\Advent\Day21;

use Advent\Day21\Scrambler;
use PhpSpec\ObjectBehavior;

class ScramblerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Scrambler::class);
    }

    public function it_can_swap_positions()
    {
        $x = 4;
        $y = 0;
        $input = 'abcde';
        $this->swapPosition($input, $x, $y)->shouldBe('ebcda');
    }

    public function it_can_swap_letters()
    {
        $letterX = 'd';
        $letterY = 'b';
        $input = 'ebcda';
        $this->swapLetters($input, $letterX, $letterY);
    }

    public function it_can_rotate_input_right()
    {
        $input = 'abcd';
        $direction = 'right';
        $steps = 1;
        $this->rotateSteps($input, $direction, $steps)->shouldBe('dabc');
    }

    public function it_can_rotate_none()
    {
        $input = uniqid('input_', true);
        $this->rotateSteps($input, 'left', 0)->shouldBe($input);
    }

    public function it_can_rotate_left()
    {
        $input = 'abcdefg';
        $this->rotateSteps($input, 'left', 3)->shouldBe('defgabc');
    }

    public function it_can_rotate_based_on_letter()
    {
        $input = 'abdec';
        $this->rotateLetter($input, 'b')->shouldBe('ecabd');
    }

    public function it_can_reverse_letters_between_positions()
    {
        $input = 'edcba';
        $x = 0;
        $y = 4;
        $this->reverseBetween($input, $x, $y)->shouldBe('abcde');
    }

    public function it_can_reverse_between_2()
    {
        $input = 'gfcbadhe';
        $this->reverseBetween($input, 2, 7)->shouldBe('gfehdabc');
    }

    public function it_can_reverse_letters_between_2()
    {
        $input = 'abcde';
        $this->reverseBetween($input, 1, 3)->shouldBe('adcbe');
    }

    public function it_can_move_letter_from_position_x_to_position_y()
    {
        $input = 'bcdea';
        $x     = 1;
        $y     = 4;
        $this->movePosition($input, $x, $y)->shouldBe('bdeac');
    }

    public function it_can_move_letter_positions_2()
    {
        $this->movePosition('bdeac', 3, 0)->shouldBe('abdec');
    }

    public function it_should_put_stuff_back_with_reverse_twice()
    {
        $input = 'abcdefgh';
        $this->reverseBetween($input, 1, 4)->shouldBe('aedcbfgh');
        $this->reverseBetween('aedcbfgh', 1, 4)->shouldBe($input);
    }
}
