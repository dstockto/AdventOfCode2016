<?php
declare(strict_types = 1);

namespace Advent\Day7;

class IPAddress
{
    private $address;

    public function __construct($address)
    {
        $this->address = trim($address);
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function supportsTLS(): bool
    {
        return $this->hasAbba() && !$this->hasHypernetAbba();
    }

    public function hasAbba(): bool
    {
        return $this->containsAbba($this->address);
    }

    public function getHypernets(): array
    {
        preg_match_all('#\[([^\]]*)\]#', $this->address, $matches);
        return $matches[1];
    }

    private function containsAbba($string): bool
    {
        $matchCount = preg_match('#(.)(.)\2\1#', $string, $matches);

        return $matchCount == 1 && ($matches[1] != $matches[2]);
    }

    public function hasHypernetAbba(): bool
    {
        return collect($this->getHypernets())->filter(
                function ($hypernet) {
                    return $this->containsAbba($hypernet);
                }
            )->count() > 0;

    }

    public function supportsSSL(): bool
    {
        $abas = $this->getABAs();
        if (count($abas) == 0) {
            return false;
        }
        return count($this->getBABs($this->getABAs())) != 0;
    }

    public function getABAs(): array
    {
        $supernets = $this->getSupernets();

        $abas = [];
        foreach ($supernets as $supernet) {
            for ($start = 0; $start < strlen($supernet) - 2; $start++) {
                if (($supernet[$start] == $supernet[$start + 2])
                    && ($supernet[$start] != $supernet[$start + 1])
                ) {
                    $abas[] = $supernet[$start] . $supernet[$start + 1] . $supernet[$start + 2];
                }
            }
        }

        return $abas;
    }

    public function getBABs(array $abas): array
    {
        $hypernets = $this->getHypernets();

        $strings = [];
        foreach ($abas as $aba) {
            $strings[] = $aba[1] . $aba[0] . $aba[1];
        }
        $matcher = implode('|', $strings);

        $babs = [];
        foreach ($hypernets as $hypernet) {
            $matchCount = preg_match("/($matcher)/", $hypernet, $matches);
            if ($matchCount == 1) {
                $babs[] = $matches[1];
            }
        }

        return $babs;
    }

    public function getSupernets(): array
    {
        $parts     = explode('[', $this->address);
        $supernets = [];
        foreach ($parts as $piece) {
            if (strpos($piece, ']') === false) {
                $supernets[] = $piece;
            } else {
                list($hypernet, $supernet) = explode(']', $piece);
                $supernets[] = $supernet;
            }
        }

        return $supernets;
    }

}
