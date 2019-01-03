<?php

namespace PrimeNumbers;

use PrimeNumbers\Contracts\PrimeNumberInterface;

class PrimeNumber implements PrimeNumberInterface
{
    static $NULL;
    private $number;
    private function __construct() {}

    public static function fromNumber(int $number) : PrimeNumberInterface
    {
        if(!self::$NULL) {
            self::$NULL = NullPrimeNumber::invoke();
        }

        if(!self::isPrime($number)) {
            return self::$NULL;
        }

        $instance = new self;
        $instance->number = $number;
        return $instance;
    }

    private static function isPrime(int $num) : bool
    {
        $r1 = $num%2;
        $r2 = $num%3;
        $r3 = $num%5;
        return ($num > 1) &&  (($r1 >= 1) && ($r2 >= 1) && ($r3 >= 1)) || in_array($num, [2,3,5]);
    }

    public function getNumber() : int
    {
        return $this->number;
    }
}
