<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class PrimeNumberTest extends TestCase
{
    public function test_from_number_should_construct_for_3_prime_number()
    {
        $primeNumber = \PrimeNumbers\PrimeNumber::fromNumber(3);
        $this->assertEquals(\PrimeNumbers\PrimeNumber::fromNumber(3), $primeNumber);
    }

    public function test_from_number_should_construct_for_5_prime_number()
    {
        $primeNumber = \PrimeNumbers\PrimeNumber::fromNumber(5);
        $this->assertEquals(\PrimeNumbers\PrimeNumber::fromNumber(5), $primeNumber);
    }

    public function test_should_return_null_object_for_non_prime_number()
    {
        \PrimeNumbers\PrimeNumber::$NULL = \PrimeNumbers\NullPrimeNumber::invoke();

        $this->assertEquals(\PrimeNumbers\PrimeNumber::$NULL, \PrimeNumbers\PrimeNumber::fromNumber(4));
        $this->assertEquals(\PrimeNumbers\PrimeNumber::$NULL, \PrimeNumbers\PrimeNumber::fromNumber(10));
        $this->assertEquals(\PrimeNumbers\PrimeNumber::$NULL, \PrimeNumbers\PrimeNumber::fromNumber(12));
    }
}
