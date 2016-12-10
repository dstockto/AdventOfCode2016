<?php
declare(strict_types = 1);

namespace spec\Advent\Day10;

use Advent\Day10\Bot;
use Advent\Day10\BotObserver;
use Advent\Day10\Microchip;
use PhpSpec\ObjectBehavior;

class BotObserverSpec extends ObjectBehavior
{
    public function let()
    {
        $search1     = 61;
        $search2     = 17;
        $this->beConstructedWith($search1, $search2);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(BotObserver::class);
    }

    public function it_has_no_match_to_start()
    {
        $this->getBotIds()->shouldBe([]);
    }

    public function it_can_capture_a_bot_id_that_meets_the_criteria(Microchip $chip1, Microchip $chip2, Bot $bot)
    {
        $botId = random_int(1, 10000);
        $bot->getNumber()->willReturn($botId);
        $chip1->getValue()->willReturn(61);
        $chip2->getValue()->willReturn(17);

        $this($bot, $chip1, $chip2);

        $this->getBotIds()->shouldBe([$botId]);
    }

    public function it_will_not_capture_if_chips_are_wrong_id(Microchip $chip1, Microchip $chip2, Bot $bot)
    {
        $botId = random_int(1, 10000);
        $bot->getNumber()->willReturn($botId);
        $chip1->getValue()->willReturn(60);
        $chip2->getValue()->willReturn(17);

        $this($bot, $chip1, $chip2);

        $this->getBotIds()->shouldBe([]);
    }
}
