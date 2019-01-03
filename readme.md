# Prime Numbers

## Lists

~~~php
use PrimeNumbers\Contracts\PrimeNumberInterface;
use PrimeNumbers\{PrimeNumber, PrimeNumberAggregate};

$instance = PrimeNumberAggregate::until(10);  //2,3,5,7
~~~ 

## Filter list 

~~~php 
$filtered = $list = $instance->filter(function(PrimeNumberInterface $number) //2,3,5
{
    return ($number->getNumber() < 7);
}); 
~~~

## Delete from list 

~~~php
$deleted = $instance->delete(PrimeNumber::fromNumber(5));  //2,3,7
~~~

## Append to list 

~~~php
$appended = $instance->with(PrimeNumber::fromNumber(11));  //2,3,7,11
~~~

## Removing invalid prime numbers from list 

~~~php
$appendedWithInvalidNumber = $instance->with(PrimeNumber::fromNumber(12));
$filteredInvalidList = $instance->delete(PrimeNumber::$NULL); 
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
