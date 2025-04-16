<?php
namespace App\Http\Controllers;
 use Illuminate\Support\Facades\Auth; 
 use Illuminate\Http\Request; use
     App\Models\CodeReview; use App\Models\CodeReviewComment; class CodeReviewController extends Controller { public
     function index($reviewId=null) { // Get the latest code review or a specific one $codeReview=$reviewId ?
     $reviewId 
         ? CodeReview::with(['comments.user'])->findOrFail($reviewId) 
         : CodeReview::with(['comments.user'])->latest()->first();

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
     'tagClass' => $tagClasses[$comment->tag] ?? 'tag-style',
     'comment' => $comment->comment,
     ];
     });

     $filename = $codeReview->filename;
     $code = $codeReview->code;
     $user = Auth::user();

     return view('codereview', compact('filename', 'code', 'comments', 'user'));
     }
     }