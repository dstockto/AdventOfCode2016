<?php
declare(strict_types = 1);

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

    function it_can_get_its_own_taxi_distance_1()
    {
        $this->beConstructedWith(1, 1);
        $this->getTaxiDistance()->shouldBe(2);
    }

    function it_can_get_its_own_taxi_distance_2()
    {
        $this->beConstructedWith(2, -2);
        $this->getTaxiDistance()->shouldBe(4);
    }

    function it_can_get_a_list_of_unit_vectors_for_itself()
    {
        $this->beConstructedWith(-3, 3);
        $result = $this->getUnitMovements();
        $result->shouldHaveCount(6);
        $result[0]->getXMovement()->shouldBe(-1);
        $result[1]->getXMovement()->shouldBe(-1);
        $result[2]->getXMovement()->shouldBe(-1);

        $result[3]->getYMovement()->shouldBe(1);
        $result[4]->getYMovement()->shouldBe(1);
        $result[5]->getYMovement()->shouldBe(1);
    }
}
