<?php
declare(strict_types = 1);

namespace spec\Advent\Day16;

use Advent\Day16\DragonCurver;
use PhpSpec\ObjectBehavior;

class DragonCurverSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(DragonCurver::class);
    }

    public function it_can_curve_1()
    {
        $this->curve('1')->shouldBe('100');
    }

    public function it_can_curve_0()
    {
        $this->curve('0')->shouldBe('001');
    }

    public function it_can_curve_11111()
    {
        $this->curve('11111')->shouldBe('11111000000');
    }

    public function it_can_curve_111100001010()
    {
        $this->curve('111100001010')->shouldBe('1111000010100101011110000');
    }

    public function it_can_calculate_a_checksum()
    {
        $this->checksum('11')->shouldBe('1');
        $this->checksum('00')->shouldBe('1');
        $this->checksum('10')->shouldBe('0');
        $this->checksum('01')->shouldBe('0');

        $this->checksum('110010110100')->shouldBe('100');
    }
}

