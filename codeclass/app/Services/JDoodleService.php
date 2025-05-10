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
        $this->apiUrl = config('services.jdoodle.api_url', 'https://api.jdoodle.com/v1/execute');
        $this->clientId = config('services.jdoodle.client_id');
        $this->clientSecret = config('services.jdoodle.client_secret');
        
        Log::debug('JDoodle Service Configuration', [
            'api_url' => $this->apiUrl,
            'client_id_set' => !empty($this->clientId),
            'client_secret_set' => !empty($this->clientSecret)
        ]);
    }

    /**
     * Submit code to the JDoodle API for execution
     */
    public function submitCode($sourceCode, $languageId, $stdin = '')
    {
        // Clean the source code to remove line numbers and special characters
        $sourceCode = $this->cleanSourceCode($sourceCode);
        
        $languageMapping = [
            50 => ['language' => 'c', 'versionIndex' => '4'],
            54 => ['language' => 'cpp17', 'versionIndex' => '0'],
            62 => ['language' => 'java', 'versionIndex' => '4'],
            71 => ['language' => 'python3', 'versionIndex' => '4'],
            63 => ['language' => 'javascript', 'versionIndex' => '4'],
            68 => ['language' => 'php', 'versionIndex' => '4'],
        ];
        
        $language = $languageMapping[$languageId] ?? ['language' => 'cpp17', 'versionIndex' => '0'];
        
        $payload = [
            'clientId' => $this->clientId,
            'clientSecret' => $this->clientSecret,
            'script' => $sourceCode,
            'language' => $language['language'],
            'versionIndex' => $language['versionIndex'],
            'stdin' => $stdin
        ];
        
        Log::debug('JDoodle API request payload', [
            'language' => $language['language'],
            'versionIndex' => $language['versionIndex'],
            'code_length' => strlen($sourceCode),
            'stdin_length' => strlen($stdin),
            'code_sample' => substr($sourceCode, 0, 50) . "..."
        ]);
        
        try {
            $response = Http::timeout(15)->post($this->apiUrl, $payload);
            
            Log::debug('JDoodle API raw response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            
            if (!$response->successful()) {
                Log::error('JDoodle API error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                throw new \Exception('Failed to execute code: ' . $response->status() . ' - ' . $response->body());
            }
          
            return [
                'stdout' => $response->json('output'),
                'stderr' => $response->json('error') ?? null,
                'compile_output' => null,
                'message' => $response->json('statusCode') !== 200 ? $response->json('output') : null,
            ];
        } catch (\Exception $e) {
            Log::error('JDoodle exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
    
    /**
     * Clean source code by removing line numbers and invisible characters
     */
    private function cleanSourceCode($code)
    {
        // Remove line numbers at the beginning of lines
        $code = preg_replace('/^\s*\d+[\s\r\n]+/m', '', $code);
        
        // Remove zero-width spaces and other invisible characters
        $code = preg_replace('/[\x{200B}-\x{200D}\x{FEFF}\x{2028}\x{2029}]/u', '', $code);
        
        // Replace non-breaking spaces with regular spaces
        $code = str_replace("\xC2\xA0", ' ', $code);
        
        // Normalize line endings
        $code = str_replace(["\r\n", "\r"], "\n", $code);
        
        // Log the cleaned code
        Log::debug('Code after cleaning', [
            'length' => strlen($code),
            'first_lines' => substr($code, 0, 200)
        ]);
        
        return $code;
    }
}