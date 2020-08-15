<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\Singleton\Tests;

use Noitran\Patterns\Creational\Singleton\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_test_config_instances(): void
    {
        $firstInstance = Config::getInstance();
        $secondInstance = Config::getInstance();

        self::assertInstanceOf(Config::class, $firstInstance);
        self::assertSame($firstInstance, $secondInstance);

        // Checking how singleton saves configuration data...
        $app = 'Basic application';
        $env = 'testing';

        $firstInstance->set('app', $app);
        $firstInstance->set('env', $env);

        self::assertSame($firstInstance->get('env'), $secondInstance->get('env'));
    }
}
