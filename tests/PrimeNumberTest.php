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
        $this->assertEquals(\PrimeNumbers\PrimeNumber::$NULL, \PrimeNumbers\PrimeNumber::fromNumber(4));
        $this->assertEquals(\PrimeNumbers\PrimeNumber::$NULL, \PrimeNumbers\PrimeNumber::fromNumber(10));
        $this->assertEquals(\PrimeNumbers\PrimeNumber::$NULL, \PrimeNumbers\PrimeNumber::fromNumber(12));
    }

    public function test_should_return_valid_object_for_valid_prime_numbers()
    {
        $this->assertEquals(2, \PrimeNumbers\PrimeNumber::fromNumber(2)->getNumber());
        $this->assertEquals(3, \PrimeNumbers\PrimeNumber::fromNumber(3)->getNumber());
        $this->assertEquals(5, \PrimeNumbers\PrimeNumber::fromNumber(5)->getNumber());
        $this->assertEquals(7, \PrimeNumbers\PrimeNumber::fromNumber(7)->getNumber());
        $this->assertEquals(11, \PrimeNumbers\PrimeNumber::fromNumber(11)->getNumber());
    }
}
