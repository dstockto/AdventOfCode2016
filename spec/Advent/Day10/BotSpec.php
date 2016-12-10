<?php
declare(strict_types = 1);

namespace spec\Advent\Day10;

use Advent\Day10\Bot;
use Advent\Day10\BotObserver;
use Advent\Day10\ChipReceiver;
use Advent\Day10\Microchip;
use Advent\Day10\ReceiverContainer;
use PhpSpec\ObjectBehavior;

class BotSpec extends ObjectBehavior
{
    public function let(ReceiverContainer $container, BotObserver $observer)
    {
        $loReceiver = "Bot12";
        $hiReceiver = "Bot13";
        $botId      = 42;
        $this->beConstructedWith($loReceiver, $hiReceiver, $botId, $container, $observer);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Bot::class);
        $this->shouldHaveType(ChipReceiver::class);
    }

    public function it_knows_its_number()
    {
        $this->getNumber()->shouldBe(42);
    }

    public function it_will_give_a_high_and_low_chip_to_the_right_things(
        ReceiverContainer $container,
        Microchip $chip1,
        Microchip $chip2,
        Bot $bot12,
        Bot $bot13
    ) {
        $chip1->getValue()->willReturn(12);
        $chip2->getValue()->willReturn(13);
        $container->getBot(12)->shouldBeCalled()->willReturn($bot12);
        $container->getBot(13)->shouldBeCalled()->willReturn($bot13);

        $bot12->giveChip($chip1)->shouldBeCalled();
        $bot13->giveChip($chip2)->shouldBeCalled();

        $this->giveChip($chip1);
        $this->giveChip($chip2);
    }


    public function it_can_be_observed_by_an_observer(
        Microchip $chip1,
        Microchip $chip2,
        Bot $bot12,
        Bot $bot13,
        BotObserver $observer,
        ReceiverContainer $container
    ) {
        $chip1->getValue()->willReturn(42);
        $chip2->getValue()->willReturn(66);

        $container->getBot(12)->willReturn($bot12);
        $container->getBot(13)->willReturn($bot13);

        $this->giveChip($chip1);
        $this->giveChip($chip2);

        $observer->__invoke($this, $chip1, $chip2)->shouldBeCalled();
    }
}
