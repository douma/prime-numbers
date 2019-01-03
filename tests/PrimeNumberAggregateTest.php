<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class PrimeNumberAggregateTest extends TestCase
{
    public function test_should_construct_list_until_without_invalid_primes()
    {
        $instance = \PrimeNumbers\PrimeNumberAggregate::until(10);
        $this->assertInstanceOf(\PrimeNumbers\PrimeNumberAggregate::class, $instance);

        $this->assertEquals([
            \PrimeNumbers\PrimeNumber::fromNumber(2),
            \PrimeNumbers\PrimeNumber::fromNumber(3),
            \PrimeNumbers\PrimeNumber::fromNumber(5),
            \PrimeNumbers\PrimeNumber::fromNumber(7)
        ], $instance->getNumbers());
    }

    public function test_should_remove_and_return_new_instance()
    {
        $instance = \PrimeNumbers\PrimeNumberAggregate::until(10);
        $list = $instance->remove(\PrimeNumbers\PrimeNumber::fromNumber(2));
        $this->assertNotEquals($instance, $list);

        $this->assertEquals([
            \PrimeNumbers\PrimeNumber::fromNumber(3),
            \PrimeNumbers\PrimeNumber::fromNumber(5),
            \PrimeNumbers\PrimeNumber::fromNumber(7)
        ], $list->getNumbers());
    }

    public function test_should_add_item_and_return_new_instance()
    {
        $instance = \PrimeNumbers\PrimeNumberAggregate::until(10);
        $list = $instance->with(\PrimeNumbers\PrimeNumber::fromNumber(13));

        $this->assertEquals([
            \PrimeNumbers\PrimeNumber::fromNumber(2),
            \PrimeNumbers\PrimeNumber::fromNumber(3),
            \PrimeNumbers\PrimeNumber::fromNumber(5),
            \PrimeNumbers\PrimeNumber::fromNumber(7),
            \PrimeNumbers\PrimeNumber::fromNumber(13)
        ], $list->getNumbers());
    }

    public function test_should_filter_and_return_new_list()
    {
        $instance = \PrimeNumbers\PrimeNumberAggregate::until(10);
        $list = $instance->filter(function(\PrimeNumbers\Contracts\PrimeNumberInterface $number)
        {
            return ($number->getNumber() < 7);
        });

        $this->assertEquals([
            \PrimeNumbers\PrimeNumber::fromNumber(2),
            \PrimeNumbers\PrimeNumber::fromNumber(3),
            \PrimeNumbers\PrimeNumber::fromNumber(5),
        ], $list->getNumbers());
    }
}
