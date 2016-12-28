<?php
declare(strict_types = 1);

namespace spec\Advent\Day10;

use Advent\Day10\Bot;
use Advent\Day10\BotObserver;
use Advent\Day10\BotSpecParser;
use Advent\Day10\ReceiverContainer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BotSpecParserSpec extends ObjectBehavior
{
    public function let(ReceiverContainer $container, BotObserver $observer)
    {
        $this->beConstructedWith($container, $observer);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(BotSpecParser::class);
    }

    public function it_can_parse_bot_lines(ReceiverContainer $container)
    {
        $container->store(Argument::type(Bot::class))->shouldBeCalled();
        $this->parseLine('bot 137 gives low to bot 32 and high to bot 106')->shouldBe(true);
    }

    public function it_can_parse_lines_with_output(ReceiverContainer $container)
    {
        $container->store(Argument::type(Bot::class))->shouldBeCalled();

        $this->parseLine('bot 97 gives low to output 13 and high to bot 152')->shouldBe(true);
    }

    public function it_will_ignore_non_bot_spec_lines(ReceiverContainer $container)
    {
        $container->store(Argument::any())->shouldNotBeCalled();

        $this->parseLine('value 73 goes to bot 154')->shouldBe(false);
    }
}
