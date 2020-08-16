<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\SimpleFactory\Tests;

use Noitran\Patterns\Creational\SimpleFactory\GoogleTranslator;
use Noitran\Patterns\Creational\SimpleFactory\TranslatorFactory;
use PHPUnit\Framework\TestCase;

class SimpleFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_successfully_create_class_from_factory(): void
    {
        $translator = (new TranslatorFactory())->create();

        self::assertInstanceOf(GoogleTranslator::class, $translator);
    }
}
