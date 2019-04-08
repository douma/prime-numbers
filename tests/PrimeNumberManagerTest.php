<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class PrimeNumberManagerTest extends TestCase
{
    public function test_should_construct_list_until_without_invalid_primes()
    {
        $instance = \PrimeNumbers\PrimeNumberManager::until(10);
        $this->assertInstanceOf(\PrimeNumbers\PrimeNumberManager::class, $instance);

        $this->assertEquals(\PrimeNumbers\PrimeNumberManager::from([
            \PrimeNumbers\PrimeNumber::fromNumber(2),
            \PrimeNumbers\PrimeNumber::fromNumber(3),
            \PrimeNumbers\PrimeNumber::fromNumber(5),
            \PrimeNumbers\PrimeNumber::fromNumber(7)
        ]), $instance);
    }

    public function test_should_remove_and_return_new_instance()
    {
        $instance = \PrimeNumbers\PrimeNumberManager::until(10);
        $list = $instance->remove(\PrimeNumbers\PrimeNumber::fromNumber(2));
        $this->assertNotEquals($instance, $list);

        $this->assertEquals(\PrimeNumbers\PrimeNumberManager::from([
            \PrimeNumbers\PrimeNumber::fromNumber(3),
            \PrimeNumbers\PrimeNumber::fromNumber(5),
            \PrimeNumbers\PrimeNumber::fromNumber(7)
        ]), $list);
    }

    public function test_should_add_item_and_return_new_instance()
    {
        $instance = \PrimeNumbers\PrimeNumberManager::until(10);
        $list = $instance->with(\PrimeNumbers\PrimeNumber::fromNumber(13));

        $this->assertEquals(\PrimeNumbers\PrimeNumberManager::from([
            \PrimeNumbers\PrimeNumber::fromNumber(2),
            \PrimeNumbers\PrimeNumber::fromNumber(3),
            \PrimeNumbers\PrimeNumber::fromNumber(5),
            \PrimeNumbers\PrimeNumber::fromNumber(7),
            \PrimeNumbers\PrimeNumber::fromNumber(13)
        ]), $list);
    }

    public function test_should_filter_and_return_new_list()
    {
        $instance = \PrimeNumbers\PrimeNumberManager::until(10);
        $list = $instance->filter(function(\PrimeNumbers\Contracts\PrimeNumberInterface $number)
        {
            return ($number->getNumber() < 7);
        });

        $this->assertEquals(\PrimeNumbers\PrimeNumberManager::from([
            \PrimeNumbers\PrimeNumber::fromNumber(2),
            \PrimeNumbers\PrimeNumber::fromNumber(3),
            \PrimeNumbers\PrimeNumber::fromNumber(5)
        ]), $list);
    }

    public function test_each()
    {
        $instance = \PrimeNumbers\PrimeNumberManager::until(10);
        $invalid = \PrimeNumbers\PrimeNumber::fromNumber(12);
        $instance = $instance->with($invalid);

        $append = [];
        $instance->each(function(\PrimeNumbers\Contracts\PrimeNumberInterface $primeNumber) use(&$append)
        {
            $append[] = $primeNumber;
        });

        $this->assertEquals([
            \PrimeNumbers\PrimeNumber::fromNumber(2),
            \PrimeNumbers\PrimeNumber::fromNumber(3),
            \PrimeNumbers\PrimeNumber::fromNumber(5),
            \PrimeNumbers\PrimeNumber::fromNumber(7),
            \PrimeNumbers\PrimeNumber::$NULL
        ], $append);
    }

    public function test_eachValid()
    {
        $instance = \PrimeNumbers\PrimeNumberManager::until(10);
        $invalid = \PrimeNumbers\PrimeNumber::fromNumber(12);
        $instance = $instance->with($invalid);

        $append = [];
        $instance->eachValid(function(\PrimeNumbers\Contracts\PrimeNumberInterface $primeNumber) use(&$append)
        {
            $append[] = $primeNumber;
        });

        $this->assertEquals([
            \PrimeNumbers\PrimeNumber::fromNumber(2),
            \PrimeNumbers\PrimeNumber::fromNumber(3),
            \PrimeNumbers\PrimeNumber::fromNumber(5),
            \PrimeNumbers\PrimeNumber::fromNumber(7),
        ], $append);
    }
}
