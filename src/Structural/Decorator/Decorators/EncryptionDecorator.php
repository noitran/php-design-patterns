<?php

declare(strict_types=1);

namespace Noitran\Patterns\Structural\Decorator\Decorators;

use Noitran\Patterns\Structural\Decorator\Support\Encryptor;

class EncryptionDecorator extends DataDecorator
{
    private const ENCRYPTION_KEY = 'd}xD>F:]VjG."6PP';

    public function write(): string
    {
        return (new Encryptor(self::ENCRYPTION_KEY))
            ->encryptString(parent::write());
    }

    public function read(): string
    {
        return (new Encryptor(self::ENCRYPTION_KEY))
            ->decryptString(parent::read());
    }
}
