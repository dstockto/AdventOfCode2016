<?php
declare(strict_types = 1);

namespace Advent\Day13;

class IndexedMd5
{
    const NOMATCH = 'NOMATCH';
    /** @var string */
    private $salt;
    /** @var int */
    private $index;
    /** @var string */
    private $md5;
    /** @var string */
    private $match;

    public function __construct(string $salt, int $index)
    {
        $this->salt  = $salt;
        $this->index = $index;
    }

    public function getMd5(): string
    {
        if (is_null($this->md5)) {
            $this->md5 = md5($this->salt . $this->index);
        }
        return $this->md5;
    }

    public function isTriple(): bool
    {
        return $this->getMatch() !== self::NOMATCH;
    }

    public function getIndex(): int
    {
        return $this->index;
    }

    public function getTripledCharacter()
    {
        return $this->getMatch();
    }

    /**
     * @return string
     */
    private function getMatch(): string
    {
        if (is_null($this->match)) {
            preg_match('/(.)\1\1/', $this->getMd5(), $matches);
            $this->match = $matches[1] ?? self::NOMATCH;
        }

        return $this->match;
    }

    public function isQuintMatch(string $letter): bool
    {
        return strpos($this->getMd5(), str_repeat($letter, 5)) !== false;
    }

    public function isQuint(): bool
    {
        return preg_match('/(.)\1{4}/', $this->getMd5()) !== 0;
    }

    public function getQuintCharacter(): string
    {
        preg_match('/(.)\1{4}/', $this->getMd5(), $matches);
        return $matches[1] ?? self::NOMATCH;
    }
}
