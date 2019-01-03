# Prime Numbers

## Lists

~~~php
use PrimeNumbers\Contracts\PrimeNumberInterface;
use PrimeNumbers\{PrimeNumber, PrimeNumberAggregate};

//Generate a list: 2,3,5,7
$instance = PrimeNumberAggregate::until(10); 

//Filter a list: 2,3,5
$filtered = $list = $instance->filter(function(PrimeNumberInterface $number)
{
    return ($number->getNumber() < 7);
}); 

//Delete from list: 2,3,7
$deleted = $instance->delete(PrimeNumber::fromNumber(5)); 

//Append to list: 2,3,7,11
$appended = $instance->with(PrimeNumber::fromNumber(11)); 

//Removing invalid prime numbers from list 
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
