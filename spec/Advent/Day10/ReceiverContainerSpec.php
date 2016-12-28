<?php
declare(strict_types = 1);

namespace spec\Advent\Day10;

use Advent\Day10\Bot;
use Advent\Day10\OutputBin;
use Advent\Day10\ReceiverContainer;
use PhpSpec\ObjectBehavior;

class ReceiverContainerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(ReceiverContainer::class);
    }

    public function it_can_store_a_bot(Bot $bot)
    {
        $bot->getNumber()->willReturn(42);
        $this->store($bot);
        $this->getBot(42)->shouldBe($bot);
    }

    public function it_can_store_an_output(OutputBin $bin)
    {
        $bin->getNumber()->willReturn(2);
        $this->store($bin);
        $this->getOutputbin(2)->shouldBe($bin);
    }
}
