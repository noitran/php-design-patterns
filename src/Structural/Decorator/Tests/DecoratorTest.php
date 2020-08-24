<?php

declare(strict_types=1);

namespace Noitran\Patterns\Structural\Decorator\Tests;

use Noitran\Patterns\Structural\Decorator\Decorators\CompressionDecorator;
use Noitran\Patterns\Structural\Decorator\Decorators\EncryptionDecorator;
use Noitran\Patterns\Structural\Decorator\Sources\StringDataSource;
use PHPUnit\Framework\TestCase;

class DecoratorTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_encrypt_decrypt_data(): void
    {
        $string = 'The quick brown fox jumps over the lazy dog.';

        // Encrypt -> Compress
        $encrypted = (new CompressionDecorator(new EncryptionDecorator(new StringDataSource($string))))->write();

        // Decompress -> Decrypt
        $decrypted = (new EncryptionDecorator(new CompressionDecorator(new StringDataSource($encrypted))))->read();

        self::assertEquals($string, $decrypted);
    }
}
