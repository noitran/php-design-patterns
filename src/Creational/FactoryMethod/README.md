# Factory Method

## About

> Define an interface for creating an object, but let subclasses decide which class to instantiate. The factory method lets a class defer instantiation to subclasses.
> *Design Patterns: Elements of Reusable Object-Oriented Software, p. 121*

Factory Method defines a method that should be used to create objects instead of direct constructor call (`new` operator). Subclasses can override this method to change the class of objects that will be created. See "Structure" section.

## Structure

I see two ways to implement the Factory Method. Let's define the basic structure:

* **Creator:** Interface or Abstract Class that is used by all concrete creators. It can contain shared functionality used by all/most concrete creators. If factories don't differ for each type of product, then this can become a single concrete creator itself and is no longer abstract.

* **ConcreteCreator:** Overrides or Implements method of Creator - base factory method, so it returns a different type of product. The factory method doesn't have to **create** new instances all the time. It can also return existing objects from a cache, an object pool, or another source.

* **Product:** declares the Interface, which is common to all objects that can be produced by the Creator and its subclasses. It can also be an Abstract Class instead of an Interface. It is used by all ConcreteProducts.

* **ConcreteProduct:** Implementation or subclass of Product. It contains logic specific to its variation. This object is created by a ConcreteCreator. 

The first way, if the Creator acts as an interface and ConreteCreators implements that interface:

```php
/**
 * Creator
 */
interface LoggerFactory
{
    public function createLogger(): LoggerInterface;
}

/**
 * ConcreteCreator
 */
class StreamLoggerFactory implements LoggerFactory
{
    public function createLogger(): LoggerInterface
    {
        $logFile = '_logs/main.log';

        return new StreamLogger($logFile);
    }
} 
```

The second way, if Creator is an abstract class and ConcreteCreators inherits from Creator:

```php
/**
 * Creator
 */
abstract class LoggerFactory
{
	abstract public function createLogger(): LoggerInterface;
	
	/**
	 * In case if Creator is abstract class, it can have base businesss
	 * logic.
	 */
	public function someDefaultOperation(): string
	{
		$this->createLogger();
		
		// ...
		
		return $result;
	}
}

class StreamLoggerFactory extends LoggerFactory
{
    public function createLogger(): LoggerInterface
    {
        $logFile = '_logs/main.log';

        return new StreamLogger($logFile);
    }
} 
```

Check code for full example.


## Drawbacks

One of the drawbacks of this pattern could be that sometimes it can be overkill for what you’re trying to do to complete a task. A more simplified solution called - **Simple Factory Pattern** can be chosen instead.


## Useful Links

[Factory Method](http://www.design-patterns-stories.com/patterns/FactoryMethod/)

[Factory method pattern - Wikipedia](https://en.wikipedia.org/wiki/Factory_method_pattern)

[1.3. Factory Method — DesignPatternsPHP 1.0 documentation](https://designpatternsphp.readthedocs.io/en/latest/Creational/FactoryMethod/README.html)

[Factory Method Design Pattern -PHP - Stack Overflow](https://stackoverflow.com/questions/42752390/factory-method-design-pattern-php)

