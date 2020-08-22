# Adapter

## About

> Convert the interface of a class into another interface that the clients expect. Adapter lets classes work together that couldn’t otherwise because of incompatible interfaces.
> *Design Patterns: Elements of Reusable Object-Oriented Software, p. 157*

## Applications

Adapter pattern allows us to use third-party or legacy code libraries even if they aren't compatible with the existing codebase. For example, instead of rewriting existing notification functionality to connect slack, Facebook, or SMS to existing email notifications, you can create adapter classes that will act as middleware between existing codebase and third-party libraries.

* [https://github.com/illuminate/filesystem/blob/master/FilesystemAdapter.php](https://github.com/illuminate/filesystem/blob/master/FilesystemAdapter.php) - Adapter from laravel for [thephpleague/flysystem](https://github.com/thephpleague/flysystem).   
Using adapters allows us to use the same interface for local, amazon dropbox, and other drivers.

## Structure

* **Client:** Existing codebase that can consist of one or more classes that expect Target class. The Client might be more than just one class.

* **Target:** Is the Interface that the Client expects to see. It can be an 
Abstract class or Interface. The Adapter can extend this class and overwrite all the public methods.

* **Adapter:** Class that will extend or implement the Target. It’s methods, which match those of Target, are usually wrappers around the Adaptee methods.

* **Adaptee:** Class that is being wrapped with an Adapter. This class usually comes from vendor, package, or legacy code that you want to bring into your existing codebase.


## Useful Links

[Adapter pattern - Wikipedia](https://en.wikipedia.org/wiki/Adapter_pattern)

[2.1. Adapter / Wrapper — DesignPatternsPHP 1.0 documentation](https://designpatternsphp.readthedocs.io/en/latest/Structural/Adapter/README.html)

[GitHub - jolicode/slack-php-api: PHP Slack Client based on the official OpenAPI specification](https://github.com/jolicode/slack-php-api)


## Videos

[Design Patterns in PHP: Gettin' Jiggy With Adapters](https://laracasts.com/series/design-patterns-in-php/episodes/2)

[Adapter Pattern – Design Patterns (ep 8) - YouTube](https://www.youtube.com/watch?v=2PKQtcJjYvc)

