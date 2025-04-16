<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    
    public static function getDummyCertifications()
    {
        return [
            [
                'title' => 'HTML & CSS Basics',
                'date' => '2024-03-10',
                'badge' => 'badge-html-css.png',
            ],
            [
                'title' => 'JavaScript Essentials',
                'date' => '2024-04-01',
                'badge' => 'badge-js.png',
            ],
            // Add more as needed
        ];
    }
}