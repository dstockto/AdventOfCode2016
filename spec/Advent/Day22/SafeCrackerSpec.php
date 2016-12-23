<?php
declare(strict_types = 1);

namespace spec\Advent\Day22;

use Advent\Day12\Computer;
use Advent\Day22\SafeCracker;
use PhpSpec\ObjectBehavior;

class SafeCrackerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(SafeCracker::class);
    }

    public function it_is_a_computer()
    {
        $this->shouldHaveType(Computer::class);
    }

    public function it_can_run_a_program_with_tgl_instructions()
    {
        $program = [
            'cpy 2 a',
            'tgl a',
            'tgl a',
            'tgl a',
            'cpy 1 a',
            'dec a',
            'dec a',
        ];

        $this->loadInstructions($program);

        $this->runProgram();
        $this->getRegisterValue('a')->shouldBe(3);
    }
}
