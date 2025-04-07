<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CodeReviewController extends Controller
{
    public function index()
    {
        // Example data for code review
        $comments = [
            [
                'author' => 'Prof. Smith',
                'avatar' => 'https://randomuser.me/api/portraits/men/45.jpg',
                'time' => '2 hours ago',
                'tag' => 'Performance',
                'tagClass' => 'tag-performance',
                'comment' => 'Consider using reduce() method instead of for loop for better performance and readability.',
            ],
            [
                'author' => 'Alice Cooper',
                'avatar' => 'https://randomuser.me/api/portraits/women/32.jpg',
                'time' => '5 hours ago',
                'tag' => 'Style',
                'tagClass' => 'tag-style',
                'comment' => 'The variable naming is clear and follows the conventions. Good job!',
            ],
        ];

        // Pass the data to the view
        return view('codereview', compact('comments'));
    }
}