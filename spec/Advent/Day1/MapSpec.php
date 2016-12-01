<?php
declare(strict_types = 1);

namespace spec\Advent\Day1;

use Advent\Day1\Map;
use PhpSpec\ObjectBehavior;

class MapSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Map::class);
    }

    function it_can_track_visits()
    {
        $this->visit(0, 0);
        $this->didVisit(0, 0)->shouldBe(true);
        $this->didVisit(1, 1)->shouldBe(false);
        $this->visit(1, 1);
        $this->didVisit(1, 1)->shouldBe(true);
    }

    function it_will_tell_you_if_you_visited_before_when_visiting()
    {
        $this->visit(0, 0)->shouldBe(false);
        $this->visit(0, 0)->shouldBe(true);
    }
}
