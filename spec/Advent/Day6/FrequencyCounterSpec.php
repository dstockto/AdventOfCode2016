<?php
declare(strict_types = 1);

namespace spec\Advent\Day6;

use Advent\Day6\FrequencyCounter;
use PhpSpec\ObjectBehavior;

class FrequencyCounterSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(FrequencyCounter::class);
    }

    public function it_can_count_how_many_times_stuff_appears()
    {
        $this->count('a');
        $this->getCount('a')->shouldBe(1);
        $this->count('a');
        $this->getCount('a')->shouldBe(2);
    }

    public function it_can_get_the_most_frequent_letter()
    {
        $this->count('a');
        $this->count('b');
        $this->count('b');
        $this->getMostFrequent()->shouldBe('b');
        $this->count('a');
        $this->count('a');
        $this->getMostFrequent()->shouldBe('a');
    }

    public function it_can_get_the_least_frequent_letter()
    {
        $this->count('a');
        $this->getLeastFrequentLetter()->shouldBe('a');
        $this->count('a');
        $this->count('b');
        $this->getLeastFrequentLetter()->shouldBe('b');
    }
}
