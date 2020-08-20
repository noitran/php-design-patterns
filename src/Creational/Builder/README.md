# Builder

## About

> Separate the construction of a complex object from its representation so that the same construction process can create different representations.  
> *Design Patterns: Elements of Reusable Object-Oriented Software, p. 110*

There are two variations of Builder pattern:

1. **Classical Builder Pattern** - Builder with steps that can be called separately. After each step, the final object can be built, unlike in the Fluent Builder Pattern, where you need to create the object in sequence by calling each setter method one after another until all required attributes are set.

2. **Fluent Builder Pattern** - I found that there are a lot of misunderstandings, but in my opinion, this is just a Creational [Builder Pattern](https://en.wikipedia.org/wiki/Builder_pattern) with the attached Structural [Fluent Interface Pattern](https://en.wikipedia.org/wiki/Fluent_interface).

## Applications

The builder pattern is good for creating complex products, where the product stands for anything, for example, a SQL query *(select, from, where order by get...)*, or search query request *(author, title, date...)* with different filters. In this pattern, building process is managed by the director (optional, can be swapped directly with a client) and builder.

* [Laravel](https://laravel.com/docs/7.x/queries), [Doctrine](https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/reference/query-builder.html) and other Query Builders
* [PHPUnit Mock Builder](https://phpunit.de/manual/6.5/en/test-doubles.html)

*Both are implementations of Fluent Builder Pattern*


## Useful Links

[Builder pattern - Wikipedia](https://en.wikipedia.org/wiki/Builder_pattern)

[Fluent interface - Wikipedia](https://en.wikipedia.org/wiki/Fluent_interface)

[1.2. Builder — DesignPatternsPHP 1.0 documentation](https://designpatternsphp.readthedocs.io/en/latest/Creational/Builder/README.html)

[2.8. Fluent Interface — DesignPatternsPHP 1.0 documentation](https://designpatternsphp.readthedocs.io/en/latest/Structural/FluentInterface/README.html)

[Fluent Interfaces are Evil](http://ocramius.github.io/blog/fluent-interfaces-are-evil/)

[Another builder pattern for Java - Crisp's Blog](https://blog.crisp.se/2013/10/09/perlundholm/another-builder-pattern-for-java)

[java - What is the difference between a fluent interface and the Builder pattern? - Stack Overflow](https://stackoverflow.com/questions/17937755/what-is-the-difference-between-a-fluent-interface-and-the-builder-pattern)

[java - When would you use the Builder Pattern? - Stack Overflow](https://stackoverflow.com/questions/328496/when-would-you-use-the-builder-pattern/)

[Design patterns: Builder, Fluent Interface and classic builder \| by Sławomir Kowalski | Medium](https://medium.com/@sawomirkowalski/design-patterns-builder-fluent-interface-and-classic-builder-d16ad3e98f6c)
