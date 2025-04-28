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
        
        // Prepare comments for the view
        $comments = $codeReview->comments->map(function ($comment) {
            // Tag class mapping
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
                'content' => $comment->content,
                'line' => $comment->line_number,
            ];
        });
        
        return view('codereview', [
            'comments' => $comments,
            'codeReview' => $codeReview,
            'files' => $files, // Pass files to the view
            'selectedFile' => $selectedFile
        ]);
    }
}