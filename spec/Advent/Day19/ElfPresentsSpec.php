<?php
declare(strict_types = 1);

namespace spec\Advent\Day19;

use Advent\Day19\ElfPresents;
use PhpSpec\ObjectBehavior;

class ElfPresentsSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(ElfPresents::class);
    }

    public function it_can_solve_5_elves()
    {
        $this->solve(5)->shouldBe(3);
    }
}
