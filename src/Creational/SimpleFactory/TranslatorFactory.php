<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\SimpleFactory;

use GuzzleHttp\Client;

class TranslatorFactory
{
    public function create(): GoogleTranslator
    {
        $client = new Client();
        $apiKey = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxsxxxx-xxxxxxxx';

        return new GoogleTranslator($client, $apiKey);
    }
}
