<?php
declare(strict_types = 1);

namespace spec\Advent\Day7;

use Advent\Day7\IPAddress;
use PhpSpec\ObjectBehavior;

class IPAddressSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('abc[def]ghi');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(IPAddress::class);
    }

    public function it_can_tell_if_has_an_abba1()
    {
        $this->beConstructedWith('abba[mnop]qrst');
        $this->supportsTLS()->shouldBe(true);
        $this->hasHypernetAbba()->shouldBe(false);
        $this->hasAbba()->shouldBe(true);
    }

    public function it_can_tell_if_it_has_an_abba_but_not_supporting_tls()
    {
        $this->beConstructedWith('abcd[bddb]xyyx');
        $this->supportsTLS()->shouldBe(false);
        $this->hasHypernetAbba()->shouldBe(true);
        $this->hasAbba()->shouldBe(true);
    }

    public function it_can_tell_if_tls_is_supported_with_invalid_abba()
    {
        $this->beConstructedWith('aaaa[qwer]tyui');
        $this->supportsTLS()->shouldBe(false);
    }

    public function it_can_tell_if_larger_strings_support_tls()
    {
        $this->beConstructedWith('ioxxoj[asdfgh]zxcvbn');
        $this->supportsTLS()->shouldBe(true);
    }

    public function it_can_deal_with_multiple_hypernet_addresses()
    {
        $this->beConstructedWith('vjqhodfzrrqjshbhx[lezezbbswydnjnz]ejcflwytgzvyigz[hjdillhpgdyzfkloa]mxtkrysovvotkuyekba');
        $this->supportsTLS()->shouldBe(true);
    }

    public function it_can_determine_if_ip_supports_ssl()
    {
        $this->beConstructedWith('aba[bab]xyz');
        $this->getSupernets()->shouldBe(['aba', 'xyz']);
        $this->getABAs()->shouldBe(['aba']);
        $this->getBABs(['aba'])->shouldBe(['bab']);
        $this->supportsSSL()->shouldBe(true);
    }

    public function it_does_not_support_ssl_if_no_bab()
    {
        $this->beConstructedWith('xyx[xyx]xyx');
        $this->getABAs()->shouldBe(['xyx', 'xyx']);
        $this->getBABs(['xyx', 'xyx'])->shouldBe([]);
        $this->supportsSSL()->shouldBe(false);
    }

    public function it_does_not_consider_same_characters_as_bab()
    {
        $this->beConstructedWith('aaa[kek]eke');
        $this->getABAs()->shouldBe(['eke']);
        $this->getBABs(['eke'])->shouldBe(['kek']);
        $this->supportsSSL()->shouldBe(true);
    }

    public function it_will_work_properly1()
    {
        $this->beConstructedWith('olgvwasskryjoqpfyvr[hawojecuuzobgyinfi]iywikscwfnlhsgqon');

        $this->supportsSSL()->shouldBe(false);
    }

    public function it_will_work_properly2()
    {
        $this->beConstructedWith('bcnuloxdfhnyesgtdky[hvmgfzcjhhiiqino]sfipughwbebgstwrua[behnamammdxrnnok]ttpbmbflilacfvwiwd[sosjbmmjygpbfetziv]qcosdgrbfdsgqqrlhym');
        $this->getSupernets()->shouldBe(
            [
                'bcnuloxdfhnyesgtdky',
                'sfipughwbebgstwrua',
                'ttpbmbflilacfvwiwd',
                'qcosdgrbfdsgqqrlhym',
            ]
        );

        $this->getABAs()->shouldBe(['beb', 'bmb', 'lil', 'wiw']);
    }

    public function it_will_work_properly3()
    {
        $this->beConstructedWith('lcototgbpkkoxhsg[erticxnxcjwypnunco]notoouvtmgqcfdupe[hubcmesmprktstzyae]unuquevgbpxqnrib[egalxegqwowylkdjkdg]spqmkzfjnzwcwgutl');
        $this->getSupernets()->shouldBe(
            [
                'lcototgbpkkoxhsg',
                'notoouvtmgqcfdupe',
                'unuquevgbpxqnrib',
                'spqmkzfjnzwcwgutl',
            ]
        );

        $this->getHypernets()->shouldBe(
            [
                'erticxnxcjwypnunco',
                'hubcmesmprktstzyae',
                'egalxegqwowylkdjkdg',
            ]
        );
        $this->getABAs()->shouldBe(
            [
                'oto',
                'tot',
                'oto',
                'unu',
                'uqu',
                'wcw',
            ]
        );
    }
}
