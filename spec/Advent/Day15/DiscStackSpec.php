<?php
declare(strict_types = 1);

namespace spec\Advent\Day15;

use Advent\Day15\Disc;
use Advent\Day15\DiscStack;
use PhpSpec\ObjectBehavior;

class DiscStackSpec extends ObjectBehavior
{
    public function let(Disc $disc1, Disc $disc2)
    {
        $this->beConstructedWith( $disc1, $disc2);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(DiscStack::class);
    }

    public function it_can_determine_when_all_discs_are_aligned(Disc $disc1, Disc $disc2)
    {
        $disc1->isAligned(1)->willReturn(false);
        $disc1->isAligned(2)->willReturn(true);
        $disc2->isAligned(1)->willReturn(true);
        $disc2->isAligned(2)->willReturn(false);
        $disc2->isAligned(3)->willReturn(true);

        $this->getFirstAlignmentTime()->shouldBe(1);
    }
}
