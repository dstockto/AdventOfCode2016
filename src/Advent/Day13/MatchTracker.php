<?php

namespace Advent\Day13;

class MatchTracker
{
    /**
     * @var int
     */
    private $size;
    /**
     * @var string
     */
    private $key;
    /** @var IndexedMd5[] */
    private $matches;
    /** @var IndexedMd5[] */
    private $pendingTriples;


    public function __construct(int $size, string $key)
    {
        $this->size           = $size;
        $this->key            = $key;
        $this->matches        = [];
        $this->pendingTriples = collect();
    }

    public function calculateHashes()
    {
        $index = 1;
        while (count($this->matches) < $this->size) {
            $hash = new IndexedMd5($this->key, $index);
            if ($hash->isTriple()) {
                $quintLetter = $hash->getTripledCharacter();
                for ($i = 1; $i <= 1000; $i++) {
                    $quintHash = new IndexedMd5($this->key, $index + $i);
                    if ($quintHash->isQuint() && $quintHash->getQuintCharacter() == $quintLetter) {
                        echo 'Found match for ' . $hash->getIndex() . ' - ' . $hash->getMd5(
                            ) . ' at index ' . $quintHash->getIndex() . ' - ' . $quintHash->getMd5() . "\n";
                        $this->matches[] = $hash;
                    }
                }
            }

            $index++;
        }
    }

    public function getLastIndex(): int
    {
        return $this->matches[$this->size - 1]->getIndex();
    }
}
