<?php
declare(strict_types = 1);

namespace spec\Advent\Day21;

use Advent\Day21\ScrambleController;
use PhpSpec\ObjectBehavior;

class ScrambleControllerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(ScrambleController::class);
    }

    public function it_can_process_instructions()
    {
        $input = 'abcde';
        $instructions = [
            'swap position 4 with position 0',
            'swap letter d with letter b',
            'reverse positions 0 through 4',
            'rotate left 1 step',
            'move position 1 to position 4',
            'move position 3 to position 0',
            'rotate based on position of letter b',
            'rotate based on position of letter d',
        ];

        $this->processInstructions($input, $instructions)->shouldBe('decab');
    }

    public function it_can_unscramble_passwords_too()
    {
        $input = 'decab';
        $instructions = [
            'swap position 4 with position 0',
            'swap letter d with letter b',
            'reverse positions 0 through 4',
            'rotate left 1 step',
            'move position 1 to position 4',
            'move position 3 to position 0',
            'rotate based on position of letter b',
            'rotate based on position of letter d',
        ];

        $this->unscramble($input, $instructions)->shouldBe('abcde');
    }
}
