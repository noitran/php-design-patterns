# Prototype

## About

> Specify the kinds of objects to create using a prototypical instance, and create new objects by copying this prototype.  
> *Design Patterns: Elements of Reusable Object-Oriented Software, p. 133*

In PHP, Prototype Pattern is available out of the box using `clone` keyword to create an exact copy of an object and the magic method `__clone()` to manipulate with object state upon cloning. But there are some drawbacks. See the drawbacks section.

## Applications

Prototype pattern should be used when cloning or forking and modifying an existing object is needed.  
Good use case of this pattern is when you want to avoid creating a new object, for example, because of its initialization heaviness or difficulty.
For example, it requires to make new API calls to third-party services or databases to fetch data. When the first instance fetched data, other classes are cloned from first class.  
There is also another similar pattern, "Proxy," which can also solve problems with bypassing the calls to third-party services.


## Drawbacks

1. Data types that are passed by references, such as objects, require manual cloning, and cloning complex objects with circular references might be very tricky. Example is shown in a code.


## Useful Links

[Prototype pattern - Wikipedia](https://en.wikipedia.org/wiki/Prototype_pattern)

[1.5. Prototype — DesignPatternsPHP 1.0 documentation](https://designpatternsphp.readthedocs.io/en/latest/Creational/Prototype/README.html)
