# Prime numbers

## Lists

~~~php
$instance = \PrimeNumbers\PrimeNumberAggregate::until(10); //2,3,5,7
$filtered = $list = $instance->filter(function(\PrimeNumbers\Contracts\PrimeNumberInterface $number)
{
    return ($number->getNumber() < 7);
}); //2,3,5
~~~

## Prime numbers

~~~php
$primeNumber = \PrimeNumbers\PrimeNumber::fromNumber(3);
~~~

## Invalid prime numbers

Invalid prime numbers do not result in an `Exception`. Instead 
a `NullObject` is returned, which you can compare to the global `NullObject`. 

~~~php
$invalidPrimeNumber = \PrimeNumbers\PrimeNumber::fromNumber(10);

//Check invalid
if($invalidPrimeNumber == \PrimeNumbers\PrimeNumber::$NULL)
{
    //... 
}
~~~
