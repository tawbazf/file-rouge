<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JDoodleService;
use Illuminate\Support\Facades\Log;
use App\Models\CodeFile;

class CodeExecutionController extends Controller
{
    protected $jdoodle;

    public function __construct(JDoodleService $jdoodle)
    {
        $this->jdoodle = $jdoodle;
    }

    
    public function executeCode(Request $request)
{
    try {
        \Log::info('Execute code request', [
            'payload' => $request->all(),
            'code_length' => strlen($request->input('code', '')),
            'language_id' => $request->input('language_id'),
            'input' => $request->input('input', 'None')
        ]);

        $validated = $request->validate([
            'code' => 'required|string',
            'language_id' => 'required|in:50,54,62,71,63,68',
            'input' => 'nullable|string',
        ]);

        // Use the code from the request instead of hardcoding
        $response = $this->jdoodle->submitCode(
            $validated['code'],
            $validated['language_id'],
            $validated['input'] ?? ''
        );

        Log::info('JDoodle API response', [
            'stdout' => $response['stdout'] ?? 'None',
            'stderr' => $response['stderr'] ?? 'None',
            'message' => $response['message'] ?? 'None'
        ]);

        return response()->json([
            'output' => trim($response['stdout'] ?? $response['compile_output'] ?? $response['message'] ?? 'No output'),
            'error' => $response['stderr'] ?? null,
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        \Log::error('Validation error', ['errors' => $e->errors()]);
        return response()->json(['error' => $e->errors()], 422);
    } catch (\Exception $e) {
        \Log::error('Code execution error', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'request' => $request->all()
        ]);
        return response()->json([
            'error' => 'Failed to execute code: ' . $e->getMessage()
        ], 500);
    }
}

    
    
}