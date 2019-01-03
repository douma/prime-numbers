<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private $listTest = false;
    private $number;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I want a list of prime numbers up until the number :arg1
     */
    public function iWantAListOfPrimeNumbersUpUntilTheNumber($arg1)
    {
        $this->listTest = true;
        $this->number = $arg1;
    }

    /**
     * @Then the result would be :arg1
     */
    public function theResultWouldBe($arg1)
    {
        if($this->listTest)
        {
            $list = \PrimeNumbers\PrimeNumberAggregate::until($this->number);
            $result = explode(",", $arg1);
            $listNumbers = [];

            foreach($list as $primeNumber)
            {
                $listNumbers[] = (string) $primeNumber->getNumber();
            }

            if($result !== $listNumbers)
            {
                throw new \Exception("The result is not as espected, result: " . implode(",", $listNumbers));
            }
        }
        else
        {
            $prime = \PrimeNumbers\PrimeNumber::fromNumber($this->number);
            $hasError = $prime == \PrimeNumbers\PrimeNumber::$NULL;

            if($hasError && $arg1 == "true")
            {
                throw new \Exception("The following number is not a prime number: " . $this->number);
            }
        }
    }

    /**
     * @Given I want to know if the whole number :arg1 is a prime number
     */
    public function iWantToKnowIfTheWholeNumberIsAPrimeNumber($arg1)
    {
        $this->listTest = false;
        $this->number = $arg1;
    }
}
