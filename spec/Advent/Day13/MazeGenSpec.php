<?php
declare(strict_types = 1);

namespace spec\Advent\Day13;

use Advent\Day13\MazeGen;
use PhpSpec\ObjectBehavior;

class MazeGenSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(10);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(MazeGen::class);
    }

    public function it_can_build_a_maze_with_a_favorite_number()
    {
        $this->isWall(0, 0)->shouldBe(false);
        $this->isWall(1, 0)->shouldBe(true);
        $this->isWall(2, 0)->shouldBe(false);
        $this->isWall(3, 0)->shouldBe(true);
        $this->isWall(4, 0)->shouldBe(true);
    }

    public function it_can_represent_itself_as_a_string()
    {
        $maze = <<< EOMAZE
  0123456789
0 .#.####.##
1 ..#..#...#
2 #....##...
3 ###.#.###.
4 .##..#..#.
5 ..##....#.
6 #...##.###

EOMAZE;

        $this->getMazePiece(0, 0, 9, 6)->shouldBe($maze);
    }
}
