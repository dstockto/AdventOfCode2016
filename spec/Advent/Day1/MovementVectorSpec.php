<?php

namespace spec\Advent\Day1;

use Advent\Day1\MovementVector;
use PhpSpec\ObjectBehavior;

class MovementVectorSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(1, 1);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(MovementVector::class);
    }

    function it_can_get_its_x_value()
    {
        $this->getXMovement()->shouldBe(1);
    }

    function it_can_get_its_y_value()
    {
        $this->getYMovement()->shouldBe(1);
    }

    function it_can_add_with_another_vector(MovementVector $v)
    {
        $v->getXMovement()->willReturn(4);
        $v->getYMovement()->willReturn(13);

        $result = $this->addVector($v);
        $result->shouldHaveType(MovementVector::class);
        $result->getXMovement()->shouldBe(5);
        $result->getYMovement()->shouldBe(14);
    }

    function it_can_multiply_with_an_integer()
    {
        $this->beConstructedWith(1, 2);
        $result = $this->getMultipliedVector(2);

        $result->shouldHaveType(MovementVector::class);
        $result->getXMovement()->shouldBe(2);
        $result->getYMovement()->shouldBe(4);
    }
}
