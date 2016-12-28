<?php
declare(strict_types = 1);

namespace Advent\Day10;

class BotSpecParser
{
    /**
     * @var ReceiverContainer
     */
    private $container;
    /**
     * @var BotObserver
     */
    private $observer;

    public function __construct(ReceiverContainer $container, BotObserver $observer)
    {
        $this->container = $container;
        $this->observer  = $observer;
    }

    public function parseLine(string $line): bool
    {
        $count = preg_match(
            '/bot (?P<botId>\d+) gives low to (?P<loType>output|bot) (?P<loId>\d+) and high to (?P<hiType>output|bot) (?P<hiId>\d+)/',
            trim($line),
            $matches
        );
        if ($count === 0) {
            return false;
        }

        $loReceiver = ucfirst($matches['loType']) . $matches['loId'];
        $hiReceiver = ucfirst($matches['hiType']) . $matches['hiId'];
        $bot        = new Bot($loReceiver, $hiReceiver, (int)$matches['botId'], $this->container, $this->observer);
        $this->container->store($bot);
        return true;
    }
}
