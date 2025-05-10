<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\CodeReview;
use App\Models\CodeFile;

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
        $files = CodeFile::all();
        
        // Get the selected file if fileId is provided
        $selectedFile = null;
        if ($request->has('fileId')) {
            $selectedFile = CodeFile::find($request->fileId);
        } elseif ($files->count() > 0) {
            $selectedFile = $files->first();
        }
        
        \Log::info('Selected file', [
            'fileId' => $request->fileId,
            'selectedFile' => $selectedFile ? $selectedFile->toArray() : null
        ]);
        
        // Check if a code review exists
        if (!$codeReview) {
            return view('codereview', [
                'comments' => [],
                'codeReview' => null,
                'files' => $files,
                'selectedFile' => $selectedFile
            ]);
        }
        
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
                'content' => $comment->comment,
                'line' => $comment->line_number,
            ];
        })->toArray();

        return view('codereview', [
            'comments' => $comments,
            'codeReview' => $codeReview,
            'files' => $files,
            'selectedFile' => $selectedFile
        ]);
    }
}