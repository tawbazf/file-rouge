<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JDoodleService;

class CodeExecutionController extends Controller
{
    protected $jdoodle;

    public function __construct(JDoodleService $jdoodle)
    {
        $this->jdoodle = $jdoodle;
    }

    public function executeCode(Request $request)
    {
        $request->validate([
            'fileId' => 'required|exists:code_files,id',
            'language_id' => 'required|integer',
            'input' => 'nullable|string',
        ]);

        // Get the file content from your database
        $file = \App\Models\CodeFile::find($request->fileId);
        
        if (!$file) {
            return response()->json([
                'error' => 'File not found'
            ], 404);
        }
        
        try {
            $response = $this->jdoodle->submitCode(
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