<?php
declare(strict_types = 1);

namespace spec\Advent\Day15;

use Advent\Day15\Disc;
use PhpSpec\ObjectBehavior;

class DiscSpec extends ObjectBehavior
{
    public function let()
    {
        $positions = 5;
        $start = 4;
        $this->beConstructedWith($positions, $start);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Disc::class);
    }

    public function it_knows_when_it_is_aligned_based_on_time()
    {
        $this->isAligned(0)->shouldBe(false);
        $this->isAligned(1)->shouldBe(true);
    }
}
