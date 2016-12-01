<?php
declare(strict_types = 1);

namespace spec\Advent\Day1;

use Advent\Day1\Direction;
use Advent\Day1\MovementVector;
use PhpSpec\ObjectBehavior;

class DirectionSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Direction::class);
    }

    public function it_will_face_north_by_default()
    {
        $this->getDirection()->shouldBe('north');
    }

    public function it_can_face_west_to_start()
    {
        $this->beConstructedWith('west');
        $this->getDirection()->shouldBe('west');
    }

    public function it_can_face_east_to_start()
    {
        $this->beConstructedWith('east');
        $this->getDirection()->shouldBe('east');
    }

    public function it_can_face_south_to_start()
    {
        $this->beConstructedWith('south');
        $this->getDirection()->shouldBe('south');
    }

    public function it_can_face_north_to_start()
    {
        $this->beConstructedWith('north');
        $this->getDirection()->shouldBe('north');
    }

    public function it_can_turn_left()
    {
        $this->turnLeft();
        $this->getDirection()->shouldBe('west');
        $this->turnLeft();
        $this->getDirection()->shouldBe('south');
        $this->turnLeft();
        $this->getDirection()->shouldBe('east');
        $this->turnLeft();
        $this->getDirection()->shouldBe('north');
    }

    public function it_can_turn_right()
    {
        $this->turnRight();
        $this->getDirection()->shouldBe('east');
        $this->turnRight();
        $this->getDirection()->shouldBe('south');
        $this->turnRight();
        $this->getDirection()->shouldBe('west');
        $this->turnRight();
        $this->getDirection()->shouldBe('north');
    }

    public function it_can_return_a_movement_vector_for_unit_north()
    {
        $result = $this->getMovementVector(1);
        $result->shouldHaveType(MovementVector::class);
        $result->getXMovement()->shouldBe(0);
        $result->getYMovement()->shouldBe(1);
    }

    public function it_can_return_a_movement_vector_for_multiplied_east()
    {
        $this->beConstructedWith('east');
        $result = $this->getMovementVector(8);
        $result->shouldHaveType(MovementVector::class);
        $result->getXMovement()->shouldBe(8);
        $result->getYMovement()->shouldBe(0);
    }

    public function it_can_return_movement_vector_for_west()
    {
        $this->beConstructedWith('west');
        $result = $this->getMovementVector(2);
        $result->shouldHaveType(MovementVector::class);
        $result->getXMovement()->shouldBe(-2);
        $result->getYMovement()->shouldBe(0);
    }

    public function it_can_return_movement_ventor_for_south()
    {
        $this->beConstructedWith('south');
        $result = $this->getMovementVector(3);
        $result->shouldHaveType(MovementVector::class);
        $result->getXMovement()->shouldBe(0);
        $result->getYMovement()->shouldBe(-3);
    }
}
