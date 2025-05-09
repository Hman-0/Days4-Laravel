<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Tạo 10 users và profiles với dữ liệu ngẫu nhiên
        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('password'),
            ]);

            Profile::create([
                'user_id' => $user->id,
                'bio' => fake()->sentence(),
                'birthday' => fake()->date(),
                'avatar_url' => 'https://i.pravatar.cc/150?img='.$i,
            ]);
        }

        // Tạo 10 khóa học với dữ liệu đa dạng
        $courses = [
            [
                'title' => 'Lập trình PHP cơ bản',
                'description' => 'Khóa học PHP từ cơ bản đến nâng cao',
                'user_id' => rand(1, 10),
            ],
            [
                'title' => 'Laravel Framework',
                'description' => 'Học Laravel framework từ A-Z',
                'user_id' => rand(1, 10),
            ],
            [
                'title' => 'ReactJS Frontend',
                'description' => 'Xây dựng ứng dụng web với ReactJS',
                'user_id' => rand(1, 10),
            ],
            [
                'title' => 'Node.js Backend',
                'description' => 'Xây dựng API với Node.js',
                'user_id' => rand(1, 10),
            ],
            [
                'title' => 'Vue.js Mastery',
                'description' => 'Làm chủ Vue.js trong 4 tuần',
                'user_id' => rand(1, 10),
            ],
            [
                'title' => 'Flutter Mobile Development',
                'description' => 'Xây dựng ứng dụng di động đa nền tảng',
                'user_id' => rand(1, 10),
            ],
            [
                'title' => 'Python Data Science',
                'description' => 'Phân tích dữ liệu với Python',
                'user_id' => rand(1, 10),
            ],
            [
                'title' => 'AWS Cloud Computing',
                'description' => 'Triển khai hệ thống trên AWS',
                'user_id' => rand(1, 10),
            ],
            [
                'title' => 'Docker & Kubernetes',
                'description' => 'Containerization và orchestration',
                'user_id' => rand(1, 10),
            ],
            [
                'title' => 'Machine Learning Basics',
                'description' => 'Nhập môn Machine Learning',
                'user_id' => rand(1, 10),
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }

        // Tạo 10 bài học ngẫu nhiên cho mỗi khóa học
        $courses = Course::all();
        foreach ($courses as $course) {
            for ($i = 1; $i <= 10; $i++) {
                Lesson::create([
                    'title' => fake()->sentence(),
                    'content' => fake()->paragraphs(3, true),
                    'course_id' => $course->id,
                ]);
            }
        }
    }
}
