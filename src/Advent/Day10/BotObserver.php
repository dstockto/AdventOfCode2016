<?php
declare(strict_types = 1);

namespace Advent\Day10;

class BotObserver
{
    /** @var int */
    private $search1;
    /** @var int */
    private $search2;

    private $botIds = [];

    public function __construct(int $search1, int $search2)
    {
        $this->search1 = $search1;
        $this->search2 = $search2;
    }

    public function getBotIds()
    {
        return $this->botIds;
    }

    public function __invoke(Bot $bot, Microchip $chip1, Microchip $chip2)
    {
        $search = [$this->search1, $this->search2];
        sort($search);

        $chipIds = [$chip1->getValue(), $chip2->getValue()];
        sort($chipIds);

        if ($search == $chipIds) {
            $this->botIds[] = $bot->getNumber();
        }
    }
}
