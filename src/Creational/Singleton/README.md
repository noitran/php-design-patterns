# Singleton

## About

> Ensure a class only has one instance and provide a global point of access to it.  
> *Design Patterns: Elements of Reusable Object-Oriented Software, p. 144*

**Many resources mention that Singleton is considered an anti-pattern and should be avoided prior to the Dependency Injection pattern.**

[Design Patterns in PHP: Singletons - Allan MacGregor](https://coderoncode.com/posts/design-patterns-in-php-singletons)

## Applications

I wouldn't use the Singleton pattern in the real world. You don't need to ensure the singularity of singleton when you are going to instantiate object only once. You don't need to provide a Global Access Point when you can inject the object. At example, frameworks provide Containers in which there is Singleton imitation if needed:

[Service Container - Laravel](https://laravel.com/docs/7.x/container)

[The PHP League PSR11 Container](https://container.thephpleague.com/3.x/)

Examples mentioned by others: `Database Connector`, `Filesystem`, `Config`, `EventDispatcher`, `Logger` and other. When application requires only one instance of class in code which will be shared over all codebase in global state.

## Drawbacks

1. **Singleton solves two problems - and because of this it violates Single Responsibility Principle.**

	This also is stated in [this article](https://coderoncode.com/posts/design-patterns-in-php-singletons)
	
	> Singleton objects are responsible of both their purpose and controlling the number of instances the produce, while the Single Responsibility Principle states that:  
	> … every class should have a single responsibility, and that responsibility should be entirely encapsulated by the class.
	
	But in my opinion, this can be avoided by using abstract singletons and subclassing, which is shown in my example, when parent singleton takes instance count controlling and child singletons are responsible for business logic. But still, responsibilities are strongly coupled through inheritance...

2. Impossible to unit test client code if classically using Singleton by calling ::getInstance(), and brakes **Dependency Inversion Principle (DIP)**

	For example, if the QueryBuilder class will use Singleton DB connector, which will be called via getInstance(), then it will be impossible to unit test the QueryBuilder class without actually touching the database.

	```php
	<?php
	
	class QueryBuilder
	{
		// Other code
	
		public function getAll($query)
		{
			return DB::getInstance()
				->select($query)
				->get(); // Adds concrete dependency, breaks DIP
		}
	}
	```
	Can be solved using depenceny injection and DIP.
	
	```php
	<?php
	
	class DB extends Singleton implements ConnectionInterface
	{
		// ...
	}
	```

	And then:
	
	```php
	<?php
	
	class QueryBuilder
	{
		protected ConnectionInterface $db;
			
		public function __construct(ConnectionInterface $db)
		{
			$this->db = $db;
		}
		
		public function getAll($query)
		{
			return $this->db()
				->select($query)
				->get();
		}
	}
	```

	Now can be mocked, and does not break DIP.
	
	But this makes one of the Singleton purposes "Provide a global access point to that instance." not needed, as we use **Dependency Injection** instead of **Global Access Point**
	

3. Makes impossible to use asynchronous libraries like ReactPHP based [PPM - PHP Process Manager](https://github.com/php-pm/php-pm) as Singletons can't be cloned over two or more CPU cores, and this restricts performance increase in high load applications.


## Useful Links

[1.7. Singleton — DesignPatternsPHP 1.0 documentation](https://designpatternsphp.readthedocs.io/en/latest/Creational/Singleton/README.html)

[Design Patterns in PHP: Singletons - Allan MacGregor](https://coderoncode.com/posts/design-patterns-in-php-singletons)

