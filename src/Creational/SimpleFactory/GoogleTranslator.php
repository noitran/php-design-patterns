<?php

declare(strict_types=1);

namespace Noitran\Patterns\Creational\SimpleFactory;

use GuzzleHttp\ClientInterface;
use JsonException;
use RuntimeException;

class GoogleTranslator
{
    private const TRANSLATION_URL = 'https://www.googleapis.com/language/translate/v2';

    private const DETECTION_URL = 'https://www.googleapis.com/language/translate/v2/detect';

    protected ClientInterface $client;

    protected string $apiKey;

    public function __construct(ClientInterface $client, string $apiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    public function translate(string $text, string $targetLang, ?string $sourceLang = null): ?string
    {
        $sourceLang = $sourceLang ?: $this->detect($text);

        $requestUrl = $this->buildRequestUrl($this->translationUrl(), [
            'q' => $text,
            'source' => $sourceLang,
            'target' => $targetLang,
        ]);

        $response = $this->makeRequest($requestUrl);

        if (isset($response['data']['translations']) && count($response['data']['translations']) > 0) {
            return $response['data']['translations'][0]['translatedText'];
        }

        return null;
    }

    public function detect($text): string
    {
        $requestUrl = $this->buildRequestUrl($this->detectionUrl(), [
            'q' => $text,
        ]);

        $response = $this->makeRequest($requestUrl);

        if (isset($response['data']['detections'])) {
            return $response['data']['detections'][0][0]['language'];
        }

        throw new RuntimeException('Could not detect source language.');
    }

    protected function client(): ClientInterface
    {
        return $this->client;
    }

    protected function apiKey(): string
    {
        return $this->apiKey;
    }

    protected function translationUrl(): string
    {
        return self::TRANSLATION_URL . '?key=' . $this->apiKey();
    }

    protected function detectionUrl(): string
    {
        return self::DETECTION_URL . '?key=' . $this->apiKey();
    }

    protected function buildRequestUrl($url, $queryParams = []): string
    {
        $query = http_build_query($queryParams);

        return $url . '&' . $query;
    }

    protected function makeRequest($toUrl)
    {
        $response = $this->client()->get($toUrl);

        try {
            return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new RuntimeException('Could not parse response from google.');
        }
    }
}
