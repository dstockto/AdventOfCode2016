<?php

namespace spec\Advent\Day1;

use Advent\Day1\Document;
use Advent\Day1\MovementVector;
use PhpSpec\ObjectBehavior;

class DocumentSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Document::class);
    }

    function it_is_where_it_starts()
    {
        $result = $this->getDistance();
        $result->shouldHaveType(MovementVector::class);
        $result->getXMovement()->shouldBe(0);
        $result->getYMovement()->shouldBe(0);
    }

    function it_is_two_blocks_east_and_three_north_for_R2_L3()
    {
        $this->beConstructedWith('R2, L3');
        $result = $this->getDistance();
        $result->shouldHaveType(MovementVector::class);
        $result->getXMovement()->shouldBe(2);
        $result->getYMovement()->shouldBe(3);
    }

    function it_can_return_taxi_distance()
    {
        $this->beConstructedWith('R2, L3');
        $this->getTaxiDistance()->shouldBe(5);
    }

    function it_can_pass_the_example_part2()
    {
        $this->beConstructedWith('R2, R2, R2');
        $this->getTaxiDistance()->shouldBe(2);
    }

    function it_can_pass_the_example_part3()
    {
        $this->beConstructedWith('R5, L5, R5, R3');
        $this->getTaxiDistance()->shouldBe(12);
    }

    function it_can_solve_part1()
    {
        $this->beConstructedWith('L4, L1, R4, R1, R1, L3, R5, L5, L2, L3, R2, R1, L4, R5, R4, L2, R1, R3, L5, R1, L3, L2, R5, L4, L5, R1, R2, L1, R5, L3, R2, R2, L1, R5, R2, L1, L1, R2, L1, R1, L2, L2, R4, R3, R2, L3, L188, L3, R2, R54, R1, R1, L2, L4, L3, L2, R3, L1, L1, R3, R5, L1, R5, L1, L1, R2, R4, R4, L5, L4, L1, R2, R4, R5, L2, L3, R5, L5, R1, R5, L2, R4, L2, L1, R4, R3, R4, L4, R3, L4, R78, R2, L3, R188, R2, R3, L2, R2, R3, R1, R5, R1, L1, L1, R4, R2, R1, R5, L1, R4, L4, R2, R5, L2, L5, R4, L3, L2, R1, R1, L5, L4, R1, L5, L1, L5, L1, L4, L3, L5, R4, R5, R2, L5, R5, R5, R4, R2, L1, L2, R3, R5, R5, R5, L2, L1, R4, R3, R1, L4, L2, L3, R2, L3, L5, L2, L2, L1, L2, R5, L2, L2, L3, L1, R1, L4, R2, L4, R3, R5, R3, R4, R1, R5, L3, L5, L5, L3, L2, L1, R3, L4, R3, R2, L1, R3, R1, L2, R4, L3, L3, L3, L1, L2');
        $this->getTaxiDistance()->shouldBe(279);
    }
}
