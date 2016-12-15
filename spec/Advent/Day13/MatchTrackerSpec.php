<?php

namespace spec\Advent\Day13;

use Advent\Day13\MatchTracker;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MatchTrackerSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(64, 'abc');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(MatchTracker::class);
    }

    public function it_can_track_matches_of_three_consecutive_letters()
    {
        $this->calculateHashes();
        $this->getLastIndex()->shouldBe(22728);
    }

    public function it_can_run_the_real_input()
    {
        $this->beConstructedWith(64, 'ngcjuoqr');
        $this->calculateHashes();
        $this->getLastIndex()->shouldBe(18626);

        // 12291 - too low
        // 12490 - too low
    }
}
