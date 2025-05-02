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
            // Log the incoming request for debugging
            Log::info('Code execution request received', [
                'fileId' => $request->fileId,
                'language_id' => $request->language_id,
                'input' => $request->input
            ]);
            
            // Validate the request
            $validated = $request->validate([
                'fileId' => 'required',
                'language_id' => 'required',
                'input' => 'nullable|string',
            ]);
            
            // Find the file
            $file = CodeFile::find($request->fileId);
            
            if (!$file) {
                Log::warning('File not found', ['fileId' => $request->fileId]);
                return response()->json([
                    'error' => 'File not found with ID: ' . $request->fileId
                ], 404);
            }
            
            // For now, just return a success response with the file content
            // This helps us verify that we can at least find the file
            return response()->json([
                'output' => "File found successfully!\nFilename: {$file->filename}\nContent length: " . strlen($file->content) . " characters",
                'error' => null
            ]);
            
            // We'll implement actual code execution in the next step
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error', ['errors' => $e->errors()]);
            return response()->json([
                'error' => 'Validation error: ' . json_encode($e->errors())
            ], 422);
        } catch (\Exception $e) {
            Log::error('Code execution error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'error' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }
}