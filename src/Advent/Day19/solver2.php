<?php
declare(strict_types = 1);

require_once __DIR__ . '/../../../vendor/autoload.php';

class LinkedElf
{
    /**
     * @var int
     */
    private $number;

    /** @var LinkedElf */
    private $nextElf;

    public function __construct(int $number)
    {
        $this->number = $number;
    }

    public function setNextElf(LinkedElf $elf)
    {
        $this->nextElf = $elf;
    }

    public function removeNext()
    {
        $elfAfter = $this->nextElf->nextElf;
        unset($this->nextElf->nextElf);
        $this->nextElf = $elfAfter;
    }

    public function isSurvivor(): bool
    {
        return $this->nextElf === $this;
    }

    public function getNextElf()
    {
        return $this->nextElf;
    }

    public function getNumber()
    {
        return $this->number;
    }
}

class ElfList
{
    private $count;

    private $current;
    private $across;

    public function __construct($numberOfElves)
    {
        $this->count = $numberOfElves;
        $first = new LinkedElf(1);

        $current = $first;
        for ($i = 2; $i <= $numberOfElves; $i++) {
            $elf = new LinkedElf($i);
            $current->setNextElf($elf);
            $current = $elf;
        }
        $current->setNextElf($first);

        $this->current = $first;
    }

    public function eliminateAcrossTable()
    {
        if (is_null($this->across)) {
            $justBeforeAcrossTable = floor($this->count / 2) - 1;

            $elf = $this->current;
            for ($i = 0; $i < $justBeforeAcrossTable; $i++) {
                $elf = $elf->getNextElf();
            }
            $this->across = $elf;
        }

        if ($this->count == 3) {
            $foo = 'bar';
        }

        $elf = $this->across;
        echo "Across the table is " . $elf->getNextElf()->getNumber() . "\n";

        $elf->removeNext();
        if ($this->count % 2 == 0) {
            $this->across = $this->across->getNextElf()->getNextElf();
        } else {
            $this->across = $this->across->getNextElf();
        }

        $this->current = $this->current->getNextElf();
        $this->count--;
        if ($this->count % 10000 == 0) {
            echo $this->count . " elves remaining\n";
        }
    }

    public function getCurrentElf(): LinkedElf
    {
        return $this->current;
    }

    public function getCount()
    {
        return $this->count;
    }
}

$elfCount = 5;
//$elfCount = 5;

$list = new ElfList($elfCount);

while ($list->getCount() != 1) {
    $list->eliminateAcrossTable();
}

echo "Winner elf is " . $list->getCurrentElf()->getNumber() . "\n";