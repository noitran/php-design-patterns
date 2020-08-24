<?php

declare(strict_types=1);

namespace Noitran\Patterns\Structural\Decorator\Support;

use JsonException;
use RuntimeException;
use function openssl_decrypt;
use function openssl_encrypt;

/**
 * https://github.com/laravel/framework/blob/7.x/src/Illuminate/Encryption/Encrypter.php.
 */
class Encryptor
{
    protected string $key;

    protected string $cipher;

    public function __construct($key, $cipher = 'AES-128-CBC')
    {
        $key = (string) $key;

        if (static::supported($key, $cipher)) {
            $this->key = $key;
            $this->cipher = $cipher;
        } else {
            throw new RuntimeException('The only supported ciphers are AES-128-CBC and AES-256-CBC with the correct key lengths.');
        }
    }

    public static function supported($key, $cipher): bool
    {
        $length = mb_strlen($key, '8bit');

        return ('AES-128-CBC' === $cipher && 16 === $length) ||
               ('AES-256-CBC' === $cipher && 32 === $length);
    }

    public static function generateKey(string $cipher): string
    {
        return random_bytes('AES-128-CBC' === $cipher ? 16 : 32);
    }

    public function encrypt($value, $serialize = true): string
    {
        $iv = random_bytes(openssl_cipher_iv_length($this->cipher));

        $value = openssl_encrypt(
            $serialize ? serialize($value) : $value,
            $this->cipher,
            $this->key,
            0,
            $iv
        );

        if (false === $value) {
            throw new RuntimeException('Could not encrypt the data.');
        }

        $mac = $this->hash($iv = base64_encode($iv), $value);

        try {
            $json = json_encode(compact('iv', 'value', 'mac'), JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES);
        } catch (JsonException $e) {
            throw new RuntimeException('Could not encrypt the data.');
        }

        return base64_encode($json);
    }

    public function encryptString($value): string
    {
        return $this->encrypt($value, false);
    }

    public function decrypt($payload, $unserialize = true)
    {
        $payload = $this->getJsonPayload($payload);

        $iv = base64_decode($payload['iv']);
        $decrypted = openssl_decrypt(
            $payload['value'],
            $this->cipher,
            $this->key,
            0,
            $iv
        );

        if (false === $decrypted) {
            throw new RuntimeException('Could not decrypt the data.');
        }

        return $unserialize ? unserialize($decrypted) : $decrypted;
    }

    public function decryptString($payload): string
    {
        return $this->decrypt($payload, false);
    }

    protected function hash($iv, $value): string
    {
        return hash_hmac('sha256', $iv . $value, $this->key);
    }

    protected function getJsonPayload($payload): array
    {
        $payload = json_decode(base64_decode($payload), true, 512, JSON_THROW_ON_ERROR);

        if (! $this->validPayload($payload)) {
            throw new RuntimeException('The payload is invalid.');
        }

        if (! $this->validMac($payload)) {
            throw new RuntimeException('The MAC is invalid.');
        }

        return $payload;
    }

    protected function validPayload($payload): bool
    {
        return is_array($payload) && isset($payload['iv'], $payload['value'], $payload['mac']) &&
               strlen(base64_decode($payload['iv'], true)) === openssl_cipher_iv_length($this->cipher);
    }

    protected function validMac(array $payload): bool
    {
        $calculated = $this->calculateMac($payload, $bytes = random_bytes(16));

        return hash_equals(
            hash_hmac('sha256', $payload['mac'], $bytes, true),
            $calculated
        );
    }

    protected function calculateMac($payload, $bytes): string
    {
        return hash_hmac(
            'sha256',
            $this->hash($payload['iv'], $payload['value']),
            $bytes,
            true
        );
    }
}
