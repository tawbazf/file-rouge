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
        try {
            // Log the request for debugging
            Log::info('Code execution request', [
                'fileId' => $request->fileId,
                'language_id' => $request->language_id
            ]);
            
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
            
            // For testing, just return a success response
            return response()->json([
                'output' => "Code execution successful!\nFile: {$file->filename}\nLanguage ID: {$request->language_id}\nInput: {$request->input}",
                'error' => null,
            ]);
            
            // Actual code execution will be implemented later
            
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