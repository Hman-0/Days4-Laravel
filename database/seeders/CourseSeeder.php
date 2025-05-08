<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $courses = [
            [
                'title' => 'Lập trình PHP cơ bản',
                'description' => 'Khóa học PHP từ cơ bản đến nâng cao',
                'user_id' => 1,
            ],
            [
                'title' => 'Laravel Framework',
                'description' => 'Học Laravel framework từ A-Z',
                'user_id' => 1,
            ],
            [
                'title' => 'ReactJS Frontend',
                'description' => 'Xây dựng ứng dụng web với ReactJS',
                'user_id' => 2,
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}