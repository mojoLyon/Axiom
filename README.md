# Axiom [![Build Status](https://travis-ci.org/mojoLyon/Axiom.png?branch=master)](https://travis-ci.org/mojoLyon/Axiom)

## a simple business rule management system for php

Wikepedia definition :

> A **BRMS** or **Business Rule Management System** is a software system used to define, deploy, execute, monitor and maintain the variety and complexity of decision logic that is used by operational systems within an organization or enterprise. This logic, also referred to as business rules, includes policies, requirements, and conditional statements that are used to determine the tactical actions that take place in applications and systems.

Inspired by the book Enterprise Patterns and MDA written By Jim Arlow and Ila Neustadt

### Installation

Add this in your `composer.json` :

```json
{
    "require": {
        "mojolyon/axiom": "~0.1"
    }
}
```

### Usage

```php
// Setting rule with default values
$rule = new Rule('eligibleForDiscount');
$rule->add(new RuleElement\DateVariable('minCustomerSince', new \DateTime('2014-01-01 00:00:00')))
    ->add(new RuleElement\DateVariable('customerSince', new \DateTime('2014-01-01 00:00:00')))
    ->operator(Operator::GREATHER_THAN)
    ->variable('minOrder', 5)
    ->variable('customerNumberOrder', 0)
    ->operator(Operator::LESSERTHAN_OR_EQUAL)
    ->operator('and');

$ruleContext = new Context('eligibleForDiscountCustomer');
$ruleContext->add(new RuleElement\DateVariable('customerSince', new \DateTime('2013-12-11 22:00:00')))
            ->variable('customerNumberOrder', 13);

$isEligible = $rule->evaluate($ruleContext);

if ($isEligible->getValue()) {
    echo "Customer eligible for discount";
} else {
    echo "Customer not eligible for discount";
}

// will output "Customer eligible for discount"
// the rule is evaluate as : ((minCustomerSince > customerSince) and (minOrder <= customerNumberOrder))
```

There is three type of rule elements :

 - Proposition : values must be a boolean
 - Variable : values can be everything
 - DateVariable : values must be an instance of DateTime

 The base Rule have helper for adding elements :

 - Rule::operator()
 - Rule::proposition()
 - Rule::variable()

### Tests

```
$ php composer.phar install --dev
$ ./vendor/bin/atoum
```