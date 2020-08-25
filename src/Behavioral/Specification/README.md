# Specification

## About

A Specification Pattern is a Behavioral pattern whereby business rules can be combined by chaining business rules together using boolean logic.

## Applications

Widley used in Domain Driven Design. Described in detail in the document by [Eric Evans and Martin Fowler](https://www.martinfowler.com/apsupp/spec.pdf)

Usage could be in Orders, Invoices, Customers, and other entities, where boolean logic is needed. For example, was Order paid, delivered, canceled. Does the Customer have more than X orders, is Customer a golden member. A nice plus for this pattern is that you can change the logic in a single place when the business rule evolves, e.g.,>= 5 orders for premium rates instead of 3.

* [RQL](https://github.com/noitran/rql) - Resource Query Language package with Laravel/Lumen Eloquent Processor. My own implementation of Specification Pattern.

* [RulerZ](https://github.com/K-Phoen/rulerz) - Powerful implementation of the Specification pattern in PHP

## Structure

* **Specification:** An Interface that acts as parent class to all ConreteSpecifications

* **ConcreteSpecification:** Implementation of the Specification interface that has a method `isSatisfiedBy()` whose purpose is to determine if an object’s state satisfies specific business criteria and, after that, return boolean value as a result of that.

* **Item:** Object that is injected into ConcreteSpecification's `isSatisfiedBy` method.

## Useful Links

[Specifications, explained by Eric Evans and Martin Fowler](https://www.martinfowler.com/apsupp/spec.pdf)

[Specification pattern - Wikipedia](https://en.wikipedia.org/wiki/Specification_pattern)

[3.8. Specification — DesignPatternsPHP 1.0 documentation](https://designpatternsphp.readthedocs.io/en/latest/Behavioral/Specification/README.html)

[Implementing The Specification Pattern](https://culttt.com/2014/08/25/implementing-specification-pattern/)

[Design Pattern: Specification](https://marcaube.ca/2015/05/specifications)


## Videos

[Design Patterns in PHP: The Specification Pattern in PHP](https://laracasts.com/series/design-patterns-in-php/episodes/6)

[Design Patterns in PHP: The Specification Pattern in PHP: Part 2](https://laracasts.com/series/design-patterns-in-php/episodes/7)

