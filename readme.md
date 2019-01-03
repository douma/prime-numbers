# Prime Numbers

~~~php
use PrimeNumbers\Contracts\PrimeNumberInterface;
use PrimeNumbers\{PrimeNumber, PrimeNumberAggregate};

$primeNumber = PrimeNumber::fromNumber(3);
~~~

## Lists

~~~php
$list = PrimeNumberAggregate::until(10);
~~~ 

Which is the same as:

~~~php
$list = PrimeNumberAggregate::from([
    PrimeNumber::fromNumber(2),
    PrimeNumber::fromNumber(3),
    PrimeNumber::fromNumber(5),
    PrimeNumber::fromNumber(7)
];
~~~

### Filter  

~~~php 
$filtered = $list->filter(function(PrimeNumberInterface $number)
{
    return ($number->getNumber() < 7);
}); 
~~~

Which is the same as:

~~~php
$filtered = PrimeNumberAggregate::from([
    PrimeNumber::fromNumber(2),
    PrimeNumber::fromNumber(3),
    PrimeNumber::fromNumber(5)
];
~~~

### Delete

~~~php
$deleted = $list->delete(PrimeNumber::fromNumber(5)); 
~~~

Which is the same as:

~~~php
$deleted = PrimeNumberAggregate::from([
    PrimeNumber::fromNumber(2),
    PrimeNumber::fromNumber(3),
    PrimeNumber::fromNumber(7),
];
~~~

### Append 

~~~php
$appended = $list->with(PrimeNumber::fromNumber(11)); 
~~~

Which is the same as:

~~~php
$appended = PrimeNumberAggregate::from([
    PrimeNumber::fromNumber(2),
    PrimeNumber::fromNumber(3),
    PrimeNumber::fromNumber(7),
    PrimeNumber::fromNumber(11)
];
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

### Removing invalid prime numbers 

~~~php
$appendInvalid = $list->with(PrimeNumber::fromNumber(12));
~~~

Which is the same as:

~~~php
$appendInvalid = PrimeNumberAggregate::from([
    PrimeNumber::fromNumber(2),
    PrimeNumber::fromNumber(3),
    PrimeNumber::fromNumber(7),
    PrimeNumber::fromNumber(12)
];
~~~

You can remove all invalid prime numbers using a filter or the delete method:

~~~php
$removedInvalid = $appendInvalid->delete(PrimeNumber::$NULL); 

//...or
$removedInvalid = $appendInvalid->filter(function(PrimeNumberInterface $primeNumber)
{
   return $primeNumber !== PrimeNumber::$NULL;
});
~~~

Which is the same as:

~~~php
$removedInvalid = PrimeNumberAggregate::from([
    PrimeNumber::fromNumber(2),
    PrimeNumber::fromNumber(3),
    PrimeNumber::fromNumber(7)
];
~~~

## Looping 

~~~php
foreach($list as $primeNumber)
{
    if($primeNumber !== PrimeNumber::$NULL)
    {
        echo $primeNumber->getNumber();
    }
}
~~~

~~~php
$list->each(function(PrimeNumberInterface $primeNumber)
{
    if($primeNumber !== PrimeNumber::$NULL)
    {
        echo $primeNumber->getNumber();
    }
});
~~~

Or by using, `eachValid`: 

~~~php
$list->eachValid(function(PrimeNumberInterface $primeNumber)
{
    echo $primeNumber->getNumber();
});
~~~
