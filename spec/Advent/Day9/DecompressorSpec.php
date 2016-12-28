<?php
declare(strict_types = 1);

namespace spec\Advent\Day9;

use Advent\Day9\Decompressor;
use PhpSpec\ObjectBehavior;

class DecompressorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Decompressor::class);
    }

    public function it_can_decompress_uncompresed_data()
    {
        $this->decompress('ADVENT')->shouldBe('ADVENT');
    }

    public function it_can_decompress_simple_string()
    {
        $this->decompress('A(1x5)BC')->shouldBe('ABBBBBC');
    }

    public function it_can_decompress_larger_pieces()
    {
        $this->decompress('(3x3)XYZ')->shouldBe('XYZXYZXYZ');
    }

    public function it_can_decompress_doubles()
    {
        $this->decompress('A(2x2)BCD(2x2)EFG')->shouldBe('ABCBCDEFEFG');
    }

    public function it_ignores_decompression_markers_that_overlap_markers()
    {
        $this->decompress('(6x1)(1x3)A')->shouldBe('(1x3)A');
    }

    public function it_can_decompress_complex_stuff()
    {
        $this->decompress('X(8x2)(3x3)ABCY')->shouldBe('X(3x3)ABC(3x3)ABCY');
    }

    public function it_can_decompress_v2_simple_stuff()
    {
        $this->decompressV2('(3x3)XYZ')->shouldBe(9);
    }

    public function it_can_decompress_v2_more_stuff()
    {
        $this->decompressV2('X(8x2)(3x3)ABCY')->shouldBe(20);
    }

    public function it_can_decompress_massive_crap()
    {
        $this->decompressV2('(27x12)(20x12)(13x14)(7x10)(1x12)A')->shouldBe(241920);
    }

    public function it_can_decompress_odd_string()
    {
        $this->decompressV2('(25x3)(3x3)ABC(2x3)XY(5x2)PQRSTX(18x9)(3x2)TWO(5x7)SEVEN')->shouldBe(445);
    }
}
