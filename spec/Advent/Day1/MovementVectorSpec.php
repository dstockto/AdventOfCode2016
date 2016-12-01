<?php
declare(strict_types = 1);

namespace spec\Advent\Day1;

use Advent\Day1\MovementVector;
use PhpSpec\ObjectBehavior;

class MovementVectorSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(1, 1);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(MovementVector::class);
    }

    public function it_can_get_its_x_value()
    {
        $this->getXMovement()->shouldBe(1);
    }

    public function it_can_get_its_y_value()
    {
        $this->getYMovement()->shouldBe(1);
    }

    public function it_can_add_with_another_vector(MovementVector $v)
    {
        $v->getXMovement()->willReturn(4);
        $v->getYMovement()->willReturn(13);

        $result = $this->addVector($v);
        $result->shouldHaveType(MovementVector::class);
        $result->getXMovement()->shouldBe(5);
        $result->getYMovement()->shouldBe(14);
    }

    public function it_can_multiply_with_an_integer()
    {
        $this->beConstructedWith(1, 2);
        $result = $this->getMultipliedVector(2);

        $result->shouldHaveType(MovementVector::class);
        $result->getXMovement()->shouldBe(2);
        $result->getYMovement()->shouldBe(4);
    }
}
