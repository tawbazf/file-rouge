<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Judge0Service;

class CodeExecutionController extends Controller
{
    protected $judge0;

    public function __construct(Judge0Service $judge0)
    {
        $this->judge0 = $judge0;
    }

    public function executeCode(Request $request)
    {
        $request->validate([
            'fileId' => 'required|exists:files,id',
            'language_id' => 'required|integer',
            'input' => 'nullable|string',
        ]);

        // Get the file content from your database
        $file = \App\Models\CodeFile::find($request->fileId);
        
        try {
            $response = $this->judge0->submitCode(
                $file->content,
                $request->language_id,
                $request->input ?? ''
            );

            return response()->json([
                'output' => $response['stdout'] ?? $response['compile_output'] ?? $response['message'] ?? 'No output',
                'error' => $response['stderr'] ?? null,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to execute code: ' . $e->getMessage()
            ], 500);
        }
    }
}