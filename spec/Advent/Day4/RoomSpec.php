<?php
declare(strict_types = 1);

namespace spec\Advent\Day4;

use Advent\Day4\Room;
use PhpSpec\ObjectBehavior;

class RoomSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('aaaaa-bbb-z-y-x-123[abxyz]');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Room::class);
    }

    public function it_can_determine_a_room_checksum()
    {
        $this->getChecksum()->shouldBe('abxyz');
    }

    public function it_can_get_a_rooms_sector_id()
    {
        $this->getSectorId()->shouldBe(123);
    }

    public function it_can_determine_if_a_room_is_valid()
    {
        $this->isRealRoom()->shouldBe(true);
    }

    public function it_can_determine_if_a_room_is_a_decoy()
    {
        $this->beConstructedWith('aaaaa-bbb-z-y-x-123[abxyz]');
        $this->isRealRoom()->shouldBe(true);
    }

    public function it_can_determine_if_a_room_is_a_decoy2()
    {
        $this->beConstructedWith('a-b-c-d-e-f-g-h-987[abcde]');
        $this->isRealRoom()->shouldBe(true);
    }

    public function it_can_determine_if_a_room_is_a_decoy3()
    {
        $this->beConstructedWith('not-a-real-room-404[oarel]');
        $this->isRealRoom()->shouldBe(true);
    }

    public function it_can_determine_if_a_room_is_a_decoy4()
    {
        $this->beConstructedWith('totally-real-room-200[decoy]');
        $this->isRealRoom()->shouldBe(false);
    }

    public function it_can_decrypt_a_room_name()
    {
        $this->beConstructedWith('qzmt-zixmtkozy-ivhz-343[abcde]');
        $this->getDecryptedName()->shouldBe('very encrypted name');
    }
}
