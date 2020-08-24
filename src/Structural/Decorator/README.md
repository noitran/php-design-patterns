# Decorator

## About

> Attach additional responsibilities to an object dynamically. Decorators provide a flexible alternative to subclassing for extending functionality.   
> *Design Patterns: Elements of Reusable Object-Oriented Software, p. 196*


## Applications

Decorators dynamically extend the functionality of a class and help to prevent breaking of the Open/Closed Principle. If inheritance extends the functionality of classes before runtime, Decorators extend the functionality of real-time objects during runtime. Decorators are wrapping real objects, giving the ability to change object behavior at runtime.

In Java very popular example would be [InputStream](http://tutorials.jenkov.com/java-io/inputstream.html) and it's Decorators: `FileInputStream`, `BufferedInputStream`, `GZIPInputStream` and others.

[OutputStream](http://tutorials.jenkov.com/java-io/outputstream.html) and its  Decorator classes.

**Note:** Decorator pattern can be recognized by creation methods or constructor that accept objects of the same class or interface as a current class.


## Structure

* **Component:** An abstract class or interface that acts as the parent class for ConcreteComponent.

* **ConcreteComponent:** There can be multiple concrete variations of the Component. This acts as the child's class and will be the actual object being wrapped by the Decorator.

* **Decorator:** This abstract class acts as a base class for all the concrete decorators. This class will most likely share the same public interface as the Component and uses a constructor that takes a Component to wrap. The Decorator public method that is called will typically proxy the same public method for the Component.

* **ConcreteDecorator:** Concrete decorators can override methods from the base Decorator class and make use of the wrapped ConcreteComponent object that has been injected via the constructor. In addition to overwriting existing methods, other supplementary methods can be added.


## Drawbacks

1. If Decorators have custom methods, the only method from the last decorator will be available. Previous decorators that were used on the object won't be available anymore.
2. If type hinting is used, you must remember that a Decorator does not implement its Component. It wraps it. Thus, if you are using type hinting such as someMethod(Component $component), this will throw an error because technically a Decorator is not a type of Component. 
3. It can become more and more difficult to debug if there are a lot of decorations going on.


## Useful Links

[Decorator pattern - Wikipedia](https://en.wikipedia.org/wiki/Decorator_pattern)

[2.5. Decorator — DesignPatternsPHP 1.0 documentation](https://designpatternsphp.readthedocs.io/en/latest/Structural/Decorator/README.html)

[Decorator & Presenter Design Pattern](https://www.slideshare.net/DonSchado/decorator-presenter-design-pattern)


## Videos

[Design Patterns in PHP: The Decorator Pattern](https://laracasts.com/series/design-patterns-in-php/episodes/1)

[Decorator Pattern – Design Patterns (ep 3) - YouTube](https://www.youtube.com/watch?v=GCraGHx6gso)
