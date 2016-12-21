<?php
declare(strict_types = 1);

require_once __DIR__ . '/../../../vendor/autoload.php';

class ElfList
{
    /**
     * @var int
     */
    private $number;

    /** @var ElfList */
    private $nextElf;

    public function __construct(int $number)
    {
        $this->number = $number;
    }

    public function setNextElf(ElfList $elf)
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

$elfCount = 3005290;

$first = new ElfList(1);

$current = $first;
for ($i = 2; $i <= $elfCount; $i++) {
    $elf = new ElfList($i);
    $current->setNextElf($elf);
    $current = $elf;
}
// loop it back
$current->setNextElf($first);

$current = $first;

while (!$current->isSurvivor()) {
    $current->removeNext();
    $current = $current->getNextElf();
}

echo "Winner elf is " . $current->getNumber() . "\n";