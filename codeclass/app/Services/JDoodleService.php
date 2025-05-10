<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class JDoodleService
{
    protected $apiUrl;
    protected $clientId;
    protected $clientSecret;

    public function __construct()
    {
        $this->apiUrl = Config::get('services.jdoodle.api_url', 'https://api.jdoodle.com/v1/execute');
        $this->clientId = Config::get('services.jdoodle.client_id');
        $this->clientSecret = Config::get('services.jdoodle.client_secret');
        
        Log::debug('JDoodle Service Configuration', [
            'api_url' => $this->apiUrl,
            'client_id_set' => !empty($this->clientId),
            'client_secret_set' => !empty($this->clientSecret)
        ]);
    }

    public function submitCode($sourceCode, $languageId, $stdin = '')
    {
        $languageMapping = [
            50 => ['language' => 'c', 'versionIndex' => '0'],           // C
            54 => ['language' => 'cpp', 'versionIndex' => '0'],         // C++
            62 => ['language' => 'java', 'versionIndex' => '0'],        // Java
            71 => ['language' => 'python3', 'versionIndex' => '0'],     // Python
            63 => ['language' => 'nodejs', 'versionIndex' => '0'],      // JavaScript
            68 => ['language' => 'php', 'versionIndex' => '0'],         // PHP
        ];
        
        $language = $languageMapping[$languageId] ?? ['language' => 'python3', 'versionIndex' => '0'];
        
        $payload = [
            'clientId' => $this->clientId,
            'clientSecret' => $this->clientSecret,
            'script' => $sourceCode,
            'language' => $language['language'],
            'versionIndex' => $language['versionIndex'],
            'stdin' => $stdin
        ];
        
        \Log::debug('JDoodle API request payload', [
            'url' => $this->apiUrl,
            'language' => $language['language'],
            'versionIndex' => $language['versionIndex'],
            'code_length' => strlen($sourceCode),
            'stdin_length' => strlen($stdin)
        ]);
        
        $response = Http::timeout(10)->post($this->apiUrl, $payload);
    
        if (!$response->successful()) {
            \Log::error('JDoodle API error', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            throw new \Exception('Failed to execute code: ' . $response->body());
        }
    
        return [
            'stdout' => $response->json('output'),
            'stderr' => $response->json('error') ?? null,
            'compile_output' => null,
            'message' => $response->json('statusCode') !== 200 ? $response->json('output') : null,
        ];
    }
    
    
    /**
     * Clean source code by removing line numbers and invisible characters
     */
    private function cleanSourceCode($code)
    {
        // Remove line numbers at the beginning of lines
        $code = preg_replace('/^\d+/m', '', $code);
        
        // Remove zero-width spaces and other invisible characters
        $code = preg_replace('/\x{200B}/u', '', $code);
        
        // Trim whitespace
        $code = trim($code);
        
        return $code;
    }
}