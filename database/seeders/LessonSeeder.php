<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run()
    {
        $lessons = [
            // Các bài học cho khóa PHP
            [
                'title' => 'Giới thiệu PHP',
                'content' => 'Tổng quan về ngôn ngữ PHP',
                'course_id' => 1,
            ],
            [
                'title' => 'Biến và kiểu dữ liệu',
                'content' => 'Học về các kiểu dữ liệu trong PHP',
                'course_id' => 1,
            ],
            // Các bài học cho khóa Laravel
            [
                'title' => 'Cài đặt Laravel',
                'content' => 'Hướng dẫn cài đặt Laravel',
                'course_id' => 2,
            ],
            [
                'title' => 'Route và Controller',
                'content' => 'Tìm hiểu về routing trong Laravel',
                'course_id' => 2,
            ],
            // Các bài học cho khóa ReactJS
            [
                'title' => 'JSX là gì',
                'content' => 'Tìm hiểu về JSX trong React',
                'course_id' => 3,
            ],
            [
                'title' => 'Components và Props',
                'content' => 'Xây dựng components trong React',
                'course_id' => 3,
            ],
        ];

        foreach ($lessons as $lesson) {
            Lesson::create($lesson);
        }
    }
}