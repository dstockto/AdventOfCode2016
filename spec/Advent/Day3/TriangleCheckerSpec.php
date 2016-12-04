<?php
declare(strict_types = 1);

namespace spec\Advent\Day3;

use Advent\Day3\TriangleChecker;
use PhpSpec\ObjectBehavior;

class TriangleCheckerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(TriangleChecker::class);
    }

    public function it_can_validate_a_valid_triangle()
    {
        $this->validate(3, 4, 5)->shouldBe(true);
    }

    public function it_can_determine_an_invalid_triangle()
    {
        $this->validate(1, 2, 5)->shouldBe(false);
    }
}
