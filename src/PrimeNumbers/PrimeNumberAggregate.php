<?php

namespace PrimeNumbers;

use PrimeNumbers\Contracts\PrimeNumberInterface;

class PrimeNumberAggregate
{
    private $numbers = [];
    private function __construct() {}

    public static function until(int $limit) : self
    {
        $instance = new self;
        $result = [];
        for($x=2;$x<=$limit;$x++) {
            $result[] = \PrimeNumbers\PrimeNumber::fromNumber($x);
        }
        $instance->numbers = $result;
        $instance = $instance->remove(\PrimeNumbers\PrimeNumber::$NULL);
        return $instance;
    }

    public function filter(\Closure $closure) : self
    {
        $clone = clone $this;
        $clone->numbers = array_filter($clone->numbers, $closure);
        return $clone;
    }

    public function with(PrimeNumberInterface $primeNumber) : self
    {
        $clone = clone $this;
        $clone->numbers[] = $primeNumber;
        return $clone;
    }

    public function remove(\PrimeNumbers\Contracts\PrimeNumberInterface $primeNumber) : self
    {
        $clone = clone $this;
        foreach($clone->numbers as $index=>$item) {
            if($primeNumber == $item) {
                unset($clone->numbers[$index]);
            }
        }
        $clone->numbers = array_values($clone->numbers);
        return $clone;
    }

    public function getNumbers() : iterable
    {
        return $this->numbers;
    }
}
