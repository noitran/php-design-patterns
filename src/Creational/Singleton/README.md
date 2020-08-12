# Singleton

## About

> Ensure a class only has one instance and provide a global point of access to it.  
> *Design Patterns: Elements of Reusable Object-Oriented Software, p. 144*

Creational design pattern which ensures that only one object of its kind exists and provides a single point of access to it for any other code.

**Many resources mentions that Singleton is considered as anty pattern and should be avoided in prior to Dependency Injection pattern.**

[Design Patterns in PHP: Singletons - Allan MacGregor](https://coderoncode.com/posts/design-patterns-in-php-singletons)

## Drawbacks

1. **Singleton solves two problems - and because of this it violates Single Responsibility Principle.**

	This also is stated in [this article](https://coderoncode.com/posts/design-patterns-in-php-singletons)
	
	> Singleton objects are responsible of both their purpose and controlling the number of instances the produce, while the Single Responsibility Principle states that:  
	> … every class should have a single responsibility, and that responsibility should be entirely encapsulated by the class.
	
	But in my opinion this can be avoided by using abstract singletons and subclassing, which is shown in my example, when parent singleton takes instance count controlling and child singletons are responsible for business logic. But still responibilities are strongly coupled through inheritance...

2. Impossible to unit test client code if using Singleton in classical way by calling ::getInstance(), and brakes **Dependency Inversion Principle (DIP)**

	At example if QueryBuilder class will use Singleton DB connector, which will be called via getInstance(), then it will be impossible to unit test QueryBuilder class without actually touching the database.

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
		protected Connection $db;
			
		public function __construct(Connection $db)
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

## Applications

I wouldn't use Singleton pattern in real world. You don't need to ensure singularity of singleton when you are going to instantiate object only once. You dont need to provide a Global Access point when you can inject the object. At example frameworks provide Containers in which there is Singleton imitation if needed:

[Service Container - Laravel](https://laravel.com/docs/7.x/container)

[The PHP League PSR11 Container](https://container.thephpleague.com/3.x/)

Examples mentioned by others: `Database Connector`, `Filesystem`, `Config`, `EventDispatcher`, `Logger` and other. When application requires only one instances of class in code which will be shared over all codebase in global state.






