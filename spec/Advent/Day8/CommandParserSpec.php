<?php
declare(strict_types = 1);

namespace spec\Advent\Day8;

use Advent\Day8\CommandParser;
use Advent\Day8\Grid;
use PhpSpec\ObjectBehavior;

class CommandParserSpec extends ObjectBehavior
{
    public function let(Grid $grid)
    {
        $this->beConstructedWith($grid);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CommandParser::class);
    }

    public function it_can_parse_rect_commands(Grid $grid)
    {
        $grid->rect(1, 1)->shouldBeCalled();
        $this->parse('rect 1x1');

        $grid->rect(2, 5)->shouldBeCalled();
        $this->parse('rect 2x5');
    }

    public function it_can_parse_rotate_column_commands(Grid $grid)
    {
        $grid->rotateColumn(5, 2)->shouldBeCalled();
        $this->parse('rotate column x=5 by 2');

        $grid->rotateColumn(0, 1)->shouldBeCalled();
        $this->parse('rotate column x=0 by 1');
    }

    public function it_can_parse_rotate_row(Grid $grid)
    {
        $grid->rotateRow(0, 5)->shouldBeCalled();
        $this->parse('rotate row y=0 by 5');

        $grid->rotateRow(6, 2)->shouldBeCalled();
        $this->parse('rotate row y=6 by 2');
    }
}
