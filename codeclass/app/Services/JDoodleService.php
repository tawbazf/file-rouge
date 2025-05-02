<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class JDoodleService
{
    protected $apiUrl;
    protected $clientId;
    protected $clientSecret;

    public function __construct()
    {
        $this->apiUrl = env('JDOODLE_API_URL', 'https://api.jdoodle.com/v1/execute');
        $this->clientId = env('JDOODLE_CLIENT_ID', '');
        $this->clientSecret = env('JDOODLE_CLIENT_SECRET', '');
    }

    public function submitCode($sourceCode, $languageId, $stdin = '')
    {
        // Map Judge0 language IDs to JDoodle language and version
        $languageMapping = [
            50 => ['language' => 'c', 'versionIndex' => '0'],           // C
            54 => ['language' => 'cpp', 'versionIndex' => '0'],         // C++
            62 => ['language' => 'java', 'versionIndex' => '0'],        // Java
            71 => ['language' => 'python3', 'versionIndex' => '0'],     // Python
            63 => ['language' => 'nodejs', 'versionIndex' => '0'],      // JavaScript
            68 => ['language' => 'php', 'versionIndex' => '0'],         // PHP
        ];
        
        // Default to Python if language not found
        $language = $languageMapping[$languageId] ?? ['language' => 'python3', 'versionIndex' => '0'];
        
        $response = Http::post($this->apiUrl, [
            'clientId' => $this->clientId,
            'clientSecret' => $this->clientSecret,
            'script' => $sourceCode,
            'language' => $language['language'],
            'versionIndex' => $language['versionIndex'],
            'stdin' => $stdin
        ]);

        if (!$response->successful()) {
            throw new \Exception('Failed to execute code: ' . $response->body());
        }

        return [
            'stdout' => $response->json('output'),
            'stderr' => $response->json('error') ?? null,
            'compile_output' => null,
            'message' => $response->json('statusCode') !== 200 ? $response->json('output') : null,
        ];
    }
}