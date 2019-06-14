<?php

namespace Unixslayer\Cryptography;

final class Cesar implements CesarInterface
{
    private const DEFAULT_SHIFT = 3;
    private const DEFAULT_ALPHABET = 'abcdefghijklmnopqrstuvwxyz0123456789';

    /**
     * @var int
     */
    private $shift;

    /**
     * @var string
     */
    private $alphabet;

    public function __construct(int $shift = self::DEFAULT_SHIFT, string $alphabeth = self::DEFAULT_ALPHABET)
    {
        $this->shift = $shift;
        $this->alphabet = $alphabeth;
    }

    /**
     * @param string $message
     *
     * @return string
     */
    public function cypher(string $message): string
    {
        $result = array_map(function (string $character) {
            if ($character === ' ' || ($cipherLocation = (strpos($this->alphabet, $character))) === false) {
                return $character;
            } else {
                $cipherLocation = ($cipherLocation + $this->shift) % strlen($this->alphabet);
                return substr($this->alphabet, $cipherLocation, 1);
            }
        }, str_split($message));

        return implode('', $result);
    }
}
