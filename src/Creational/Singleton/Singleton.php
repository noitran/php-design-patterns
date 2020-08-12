<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\Singleton;

use Noitran\Patterns\Creational\Singleton\Exceptions\CloneNotSupportedException;
use Noitran\Patterns\Creational\Singleton\Exceptions\UnserializeNotSupportedException;

/**
 * Base logic can be abstracted into main Singleton so not to brake Single Responsibility and
 * business logic can be moved into sub classes.
 */
abstract class Singleton
{
    private static array $instances = [];

    /**
     * Cloning and unserialization are not permitted for singletons.
     */
    public function __clone()
    {
        throw new CloneNotSupportedException('Singleton can\'t be cloned.');
    }

    /**
     * https://www.php.net/manual/en/language.oop5.magic.php
     * __sleep() method is called before serialize() and __wakeup() method is called before unserialize()
     */
    public function __wakeup()
    {
        throw new UnserializeNotSupportedException('Can\'t unserialize singleton');
    }

    /**
     * Singleton constructor.
     *
     * Constructor method can only by invoked from within class itself. It is possible using static method getInstance()
     * when you are creating a new instance of your singleton, which is stored in the protected property $instance.
     *
     * Do not set as private if you want to allow subclassing of singleton.
     * https://stackoverflow.com/questions/7987313/how-to-subclass-a-singleton-in-php
     */
    protected function __construct()
    {
        // No one but ourselves can create ourselves
    }

    public static function getInstance(): self
    {
        // static::class parameter returns actual class name where it was called, so,
        // that we can get actual class name of subclass which is initialized.
        $subClass = static::class;

        if (! isset(self::$instances[$subClass])) {
            self::$instances[$subClass] = new static;
        }

        return self::$instances[$subClass];
    }
}
