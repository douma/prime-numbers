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
        if(!self::$NULL)
        {
            self::$NULL = NullPrimeNumber::invoke();
        }

        if(!self::isPrime($number))
        {
            return self::$NULL;
        }

        $instance = new self;
        $instance->number = $number;
        return $instance;
    }

    private static function isPrime(int $num) : bool
    {
        for($x = 2;$x<$num;$x++) {
            $result = ($num / $x);
            if($result == (int) $result) {
                return false;
            }
        }
        return true;
    }

    public function getNumber() : int
    {
        return $this->number;
    }
}
