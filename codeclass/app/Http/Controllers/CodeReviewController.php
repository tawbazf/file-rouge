<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CodeReview;
use App\Models\CodeFile; // Add this import

class CodeReviewController extends Controller
{
    public function index(Request $request)
    {
        $reviewId = $request->input('review_id');
        
        // Initialize the $codeReview variable
        $codeReview = $reviewId 
            ? CodeReview::with(['comments.user'])->findOrFail($reviewId)
            : CodeReview::with(['comments.user'])->latest()->first();
        
        // Get all code files to populate the dropdown
        $files = CodeFile::all(); // Add this line
        
        // Get the selected file if fileId is provided
        $selectedFile = null;
        if ($request->has('fileId')) {
            $selectedFile = CodeFile::find($request->fileId);
        } elseif ($files->count() > 0) {
            // Default to the first file if none is selected
            $selectedFile = $files->first();
        }
        
        // Check if a code review exists
        if (!$codeReview) {
            // Handle the case when no code review exists
            return view('codereview', [
                'comments' => [],
                'codeReview' => null,
                'files' => $files, // Pass files to the view
                'selectedFile' => $selectedFile
            ]);
        }
        
       // In CodeReviewController.php
$comments = $codeReview->comments->map(function ($comment) {
    $tagClasses = [
        'Performance' => 'tag-performance',
        'Style' => 'tag-style',
        'Functionality' => 'tag-functionality',
    ];
    
    return [
        'author' => $comment->user->name,
        'avatar' => $comment->user->avatar ?? 'https://randomuser.me/api/portraits/men/32.jpg',
        'time' => $comment->created_at->diffForHumans(),
        'tag' => $comment->tag,
        'tagClass' => $tagClasses[$comment->tag] ?? '',
        'content' => $comment->comment, // Changed from content to comment
        'line' => $comment->line_number,
    ];
});
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