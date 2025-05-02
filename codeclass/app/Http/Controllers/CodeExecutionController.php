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
            // Validate the request
            $validated = $request->validate([
                'code' => 'required|string', // Now accepting direct code input
                'language_id' => 'required',
                'input' => 'nullable|string',
            ]);
            
            // Execute the code directly
            $response = $this->codeService->submitCode(
                $request->code,
                $request->language_id,
                $request->input ?? ''
            );

            return response()->json([
                'output' => $response['stdout'] ?? $response['compile_output'] ?? $response['message'] ?? 'No output',
                'error' => $response['stderr'] ?? null,
            ]);
        } catch (\Exception $e) {
            Log::error('Code execution error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'error' => 'Failed to execute code: ' . $e->getMessage()
            ], 500);
        }
    }
}