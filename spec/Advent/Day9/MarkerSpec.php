<?php
declare(strict_types = 1);

namespace spec\Advent\Day9;

use Advent\Day9\Marker;
use PhpSpec\ObjectBehavior;

class MarkerSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('(1x5)');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Marker::class);
    }

    public function it_can_retrieve_the_size()
    {
        $this->getSize()->shouldBe(1);
    }

    public function it_can_retrieve_the_repeat_value()
    {
        $this->getRepeat()->shouldBe(5);
    }

    public function it_can_get_the_marker_length()
    {
        $this->getMarkerLength()->shouldBe(5);
    }

    public function it_can_get_a_string_representation_of_the_marker()
    {
        $this->__toString()->shouldBe('(1x5)');
    }
}
