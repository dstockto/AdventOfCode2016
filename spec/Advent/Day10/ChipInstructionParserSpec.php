<?php
declare(strict_types = 1);

namespace spec\Advent\Day10;

use Advent\Day10\Bot;
use Advent\Day10\ChipInstructionParser;
use Advent\Day10\Microchip;
use Advent\Day10\ReceiverContainer;
use PhpSpec\ObjectBehavior;

class ChipInstructionParserSpec extends ObjectBehavior
{
    public function let(ReceiverContainer $container)
    {
        $this->beConstructedWith($container);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(ChipInstructionParser::class);
    }

    public function it_can_parse_chip_instructions(ReceiverContainer $container, Bot $bot)
    {
        $container->getBot(4)->willReturn($bot);
        $bot->giveChip(new Microchip(67))->shouldBeCalled();

        $this->parseLine('value 67 goes to bot 4');
    }
}
