<?php
declare(strict_types = 1);

namespace spec\Advent\Day5;

use Advent\Day5\PasswordGenerator;
use PhpSpec\ObjectBehavior;

class PasswordGeneratorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(PasswordGenerator::class);
    }

    public function it_can_solve_the_real_puzzle()
    {
        $this->solve('ffykfhsq')->shouldBe('c6697b55');
    }

    public function it_can_solve_the_example()
    {
        $this->solve('abc')->shouldBe('18f47a30');
    }

    public function it_can_solve_the_new_example()
    {
        $this->newSolve('abc')->shouldBe('05ace8e3');
    }

    public function it_can_solve_my_puzzle()
    {
        $this->newSolve('ffykfhsq')->shouldBe('8c35d1ab');
    }
}
