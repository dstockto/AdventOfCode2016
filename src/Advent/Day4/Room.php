<?php
declare(strict_types = 1);

namespace Advent\Day4;

class Room
{
    private $room;
    private $checksum;
    private $sectorId;

    public function __construct($roomCode)
    {
        preg_match('/^
            (?P<room>.*)
            -
            (?P<sectorId>\d+)
            \[
                (?P<checksum>[a-z]{5})
            \]
            $/x', $roomCode, $matches);
        $this->room = $matches['room'];
        $this->checksum = $matches['checksum'];
        $this->sectorId = (int) $matches['sectorId'];
    }

    public function getChecksum(): string
    {
        return $this->checksum;
    }

    public function getSectorId(): int
    {
        return $this->sectorId;
    }

    public function isRealRoom(): bool
    {
        $calculatedChecksum = $this->getRealChecksum();
        return $calculatedChecksum == $this->checksum;
    }

    private function getRealChecksum(): string
    {
        $letters = preg_replace('/[^a-z]/', '', $this->room);
        $count = [];
        foreach (str_split($letters) as $letter) {
            if (!isset($count[$letter])) {
                $count[$letter] = 0;
            }
            $count[$letter]++;
        }

        asort($count);
        $order = [];
        foreach ($count as $letter => $number) {
            $order[$number][] = $letter;
        }

        krsort($order);

        $checksum = '';
        foreach ($order as $set) {
            sort($set);
            $checksum .= join('', $set);
        }

        return substr($checksum, 0, 5);
    }

    public function getDecryptedName(): string
    {
        $name = $this->room;
        $name = str_replace('-', ' ', $name);

        $rotation = $this->getSectorId() % 26;

        $decrypted = '';
        foreach (str_split($name) as $letter) {
            if ($letter == ' ') {
                $decrypted .= ' ';
                continue;
            }

            $letter = ord($letter) + $rotation;
            if ($letter > ord('z')) {
                $letter -= 26;
            }
            $letter = chr($letter);

            $decrypted .= $letter;
        }

        return $decrypted;
    }
}
