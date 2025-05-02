<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'title' => 'Introduction to Web Development',
                'description' => 'Learn the basics of HTML, CSS, and JavaScript to build your first website.',
                'videos' => json_encode($this->generateVideos(3)),
                'pdfs' => json_encode($this->generatePdfs(2)),
                'level' => 'Beginner',
                'instructor' => 'John Doe',
                'instructor_avatar' => 'https://randomuser.me/api/portraits/men/1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Advanced JavaScript Concepts',
                'description' => 'Dive deep into JavaScript with topics like closures, prototypes, and async programming.',
                'videos' => json_encode($this->generateVideos(4)),
                'pdfs' => json_encode($this->generatePdfs(3)),
                'level' => 'Advanced',
                'instructor' => 'Jane Smith',
                'instructor_avatar' => 'https://randomuser.me/api/portraits/women/1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Laravel for Beginners',
                'description' => 'Start your journey with Laravel, the PHP framework for web artisans.',
                'videos' => json_encode($this->generateVideos(5)),
                'pdfs' => json_encode($this->generatePdfs(2)),
                'level' => 'Intermediate',
                'instructor' => 'Mike Johnson',
                'instructor_avatar' => 'https://randomuser.me/api/portraits/men/2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Database Design Fundamentals',
                'description' => 'Learn how to design efficient and scalable databases for your applications.',
                'videos' => json_encode($this->generateVideos(3)),
                'pdfs' => json_encode($this->generatePdfs(4)),
                'level' => 'Intermediate',
                'instructor' => 'Sarah Williams',
                'instructor_avatar' => 'https://randomuser.me/api/portraits/women/2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('courses')->insert($courses);
    }

    private function generateVideos($count)
    {
        $videos = [];
        $titles = [
            'Introduction to the Course',
            'Getting Started with the Basics',
            'Understanding Core Concepts',
            'Building Your First Project',
            'Advanced Techniques',
            'Best Practices and Tips',
            'Real-world Applications',
            'Troubleshooting Common Issues'
        ];
        
        $youtubeIds = [
            'dQw4w9WgXcQ',
            'W6NZfCO5SIk',
            'pQN-pnXPaVg',
            'rfscVS0vtbw',
            'OK_JCtrrv-c',
            'grEKMHGYyns',
            'PkZNo7MFNFg',
            '7S_tz1z_5bA'
        ];

        for ($i = 0; $i < $count; $i++) {
            $videos[] = [
                'id' => $i + 1,
                'title' => $titles[array_rand($titles)],
                'url' => 'https://www.youtube.com/embed/' . $youtubeIds[array_rand($youtubeIds)],
                'duration' => rand(5, 45) . ':' . str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT),
                'thumbnail' => 'https://img.youtube.com/vi/' . $youtubeIds[array_rand($youtubeIds)] . '/0.jpg'
            ];
        }

        return $videos;
    }

    private function generatePdfs($count)
    {
        $pdfs = [];
        $titles = [
            'Course Notes',
            'Reference Guide',
            'Cheat Sheet',
            'Exercise Workbook',
            'Project Documentation',
            'Additional Resources',
            'Case Study'
        ];

        for ($i = 0; $i < $count; $i++) {
            $pages = rand(5, 50);
            $size = rand(1, 10) . '.' . rand(1, 9);
            
            $pdfs[] = [
                'id' => $i + 1,
                'title' => $titles[array_rand($titles)],
                'url' => '/storage/course_materials/pdf_' . rand(1, 10) . '.pdf',
                'pages' => $pages,
                'size' => $size . ' MB'
            ];
        }

        return $pdfs;
    }
}