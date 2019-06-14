<?php

namespace Unixslayer\Cryptography;

interface CesarInterface
{
    /**
     * @param string $message
     *
     * @return string
     */
    public function cypher(string $message): string;
}