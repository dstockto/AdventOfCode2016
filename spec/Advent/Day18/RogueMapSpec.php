<?php
declare(strict_types = 1);

namespace spec\Advent\Day18;

use Advent\Day18\RogueMap;
use PhpSpec\ObjectBehavior;

class RogueMapSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(RogueMap::class);
    }
}
