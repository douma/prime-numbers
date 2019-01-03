# Prime Numbers

~~~php
$primeNumber = PrimeNumber::fromNumber(3);
~~~

## Lists

~~~php
use PrimeNumbers\Contracts\PrimeNumberInterface;
use PrimeNumbers\{PrimeNumber, PrimeNumberAggregate};

$list = PrimeNumberAggregate::until(10);  //2,3,5,7
~~~ 

### Filter  

~~~php 
$filtered = $list->filter(function(PrimeNumberInterface $number) //2,3,5
{
    return ($number->getNumber() < 7);
}); 
~~~

### Delete

~~~php
$deleted = $list->delete(PrimeNumber::fromNumber(5));  //2,3,7
~~~

### Append 

~~~php
$appended = $list->with(PrimeNumber::fromNumber(11));  //2,3,7,11
~~~

### Removing invalid prime numbers 

~~~php
$appendedWithInvalidNumber = $list->with(PrimeNumber::fromNumber(12));
$filteredInvalidList = $appendedWithInvalidNumber->delete(PrimeNumber::$NULL); 
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
