# Prime Numbers

## Lists

A list of prime numbers can be generated with the `until` function. 

~~~php
use PrimeNumbers\Contracts\PrimeNumberInterface;
use PrimeNumbers\{PrimeNumber, PrimeNumberAggregate};

//2,3,5,7
$instance = PrimeNumberAggregate::until(10); 

//2,3,5
$filtered = $list = $instance->filter(function(PrimeNumberInterface $number)
{
    return ($number->getNumber() < 7);
}); 
~~~

## Single prime number

~~~php
$primeNumber = PrimeNumber::fromNumber(3);
~~~

## Invalid prime numbers

Invalid prime numbers do not result in an `Exception`. Instead 
a `NullObject` is returned, which you can compare to the global `NullObject`. 

~~~php
$invalidPrimeNumber = PrimeNumber::fromNumber(10);

//Check invalid
if($invalidPrimeNumber == PrimeNumber::$NULL)
{
    //... your error handling
}
~~~
