Feature: Prime numbers

  Scenario: List of primes up until 10
    Given I want a list of prime numbers up until the number "10"
    Then the result would be "2,3,5,7"

  Scenario: List of primes up until 10
    Given I want a list of prime numbers up until the number "20"
    Then the result would be "2,3,5,7,11,13,17,19"

  Scenario: Number 3 is a prime number
    Given I want to know if the whole number "3" is a prime number
    Then the result would be "true"

  Scenario: Number 9 is a prime number
    Given I want to know if the whole number "9" is a prime number
    Then the result would be "false"
