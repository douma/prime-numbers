<?php

namespace PrimeNumbers;

use PrimeNumbers\Contracts\PrimeNumberInterface;

class NullPrimeNumber implements PrimeNumberInterface
{
    private function __construct() {}

    public static function invoke() : PrimeNumberInterface
    {
        return new self;
    }

    public function getNumber() : int
    {
        return -1;
    }
}
