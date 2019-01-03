<?php

namespace PrimeNumbers;

use PrimeNumbers\Contracts\PrimeNumberInterface;
use Closure;
use PrimeNumbers\PrimeNumber;

class PrimeNumberAggregate implements \ArrayAccess, \Iterator
{
    private $numbers = [];
    private function __construct() {}

    public static function from(array $list) : self
    {
        $instance = new self;
        $instance->numbers = $list;
        return $instance;
    }

    public static function until(int $limit) : self
    {
        $instance = new self;
        $result = [];
        for($x=2;$x<=$limit;$x++) {
            $result[] = PrimeNumber::fromNumber($x);
        }
        $instance->numbers = $result;
        $instance = $instance->remove(PrimeNumber::$NULL);
        return $instance;
    }

    public function filter(Closure $closure) : self
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

    public function remove(PrimeNumberInterface $primeNumber) : self
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

    public function offsetSet($offset, $value)
    {
        trigger_error("Not supported");
    }

    public function offsetExists($offset)
    {
        return isset($this->numbers[$offset]);
    }

    public function offsetUnset($offset)
    {
        trigger_error("Not supported");
    }

    public function offsetGet($offset)
    {
        return isset($this->numbers[$offset]) ? $this->numbers[$offset] : null;
    }

    public function rewind()
    {
        reset($this->numbers);
    }

    public function current() : PrimeNumberInterface
    {
        return current($this->numbers);
    }

    public function key()
    {
        return key($this->numbers);
    }

    public function next()
    {
        return next($this->numbers);
    }

    public function valid()
    {
        $key = key($this->numbers);
        return ($key !== NULL && $key !== FALSE);
    }
}
