<?php

namespace spec\Advent\Day13;

use Advent\Day13\IndexedMd5;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IndexedMd5Spec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('abc', 18);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(IndexedMd5::class);
    }

    public function it_can_get_the_md5()
    {
        $this->getMd5()->shouldBe('0034e0923cc38887a57bd7b1d4f953df');
    }

    public function it_can_determine_if_it_is_a_triple()
    {
        $this->isTriple()->shouldBe(true);
    }

    public function it_can_give_back_its_index()
    {
        $this->getIndex()->shouldBe(18);
    }

    public function it_can_return_the_tripled_letter()
    {
        $this->getTripledCharacter()->shouldBe('8');
    }

    public function it_can_determine_if_it_is_a_quint_match()
    {
        $this->beConstructedWith('abc', 816);
        $this->isQuintMatch('e')->shouldBe(true);

        $this->isQuintMatch('4')->shouldBe(false);
    }

    public function it_gets_a_triple_for_92()
    {
        $this->beConstructedWith('abc', 92);
        $this->isTriple()->shouldBe(true);
        $this->getTripledCharacter()->shouldBe('9');
    }

    public function it_has_a_match_for_92_at_200()
    {
        $this->beConstructedWith('abc', 200);
        $this->isQuintMatch('9')->shouldBe(true);
    }

    public function it_knows_if_it_is_a_quint()
    {
        $this->beConstructedWith('abc', 200);
        $this->isQuint()->shouldBe(true);
        $this->getQuintCharacter()->shouldBe('9');
    }
}
