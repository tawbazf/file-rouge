<?php

namespace App\Services;

use GuzzleHttp\Client;

class Judge0Service
{
    protected $client;
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = config('judge0.api_url', 'https://judge0-ce.p.rapidapi.com');
        $this->apiKey = config('judge0.api_key');
    }

    public function submitCode($sourceCode, $languageId, $stdin = '')
    {
        $response = $this->client->post("{$this->baseUrl}/submissions", [
            'headers' => [
                'X-RapidAPI-Host' => parse_url($this->baseUrl, PHP_URL_HOST),
                'X-RapidAPI-Key' => $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'source_code' => $sourceCode,
                'language_id' => $languageId,
                'stdin' => $stdin,
            ],
            'query' => [
                'base64_encoded' => 'false',
                'wait' => 'true', // Wait for execution to complete
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    public function getSubmission($token)
    {
        $response = $this->client->get("{$this->baseUrl}/submissions/{$token}", [
            'headers' => [
                'X-RapidAPI-Host' => parse_url($this->baseUrl, PHP_URL_HOST),
                'X-RapidAPI-Key' => $this->apiKey,
            ],
            'query' => [
                'base64_encoded' => 'false',
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}