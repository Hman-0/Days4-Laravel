<?php

namespace App\Console\Commands;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Tag;
use Illuminate\Console\Command;

class TestElearningRelations extends Command
{
    protected $signature = 'test:elearning';
    protected $description = 'Test E-learning relations and queries';

    public function handle()
    {
        // Tạo mới khóa học với 3 bài học
        $course = Course::create([
            'title' => 'Laravel Advanced',
            'description' => 'Learn advanced Laravel concepts',
            'user_id' => 1
        ]);

        for ($i = 1; $i <= 3; $i++) {
            $course->lessons()->create([
                'title' => "Lesson $i",
                'content' => "Content for lesson $i"
            ]);
        }

        // Gắn tags cho bài học
        $laravelTag = Tag::firstOrCreate(['name' => 'Laravel']);
        $eloquentTag = Tag::firstOrCreate(['name' => 'Eloquent']);
        
        $lesson = $course->lessons->first();
        $lesson->tags()->sync([$laravelTag->id, $eloquentTag->id]);

        // Lấy comments của course
        $courseComments = $course->comments()->with('user')->get();

        // Hiển thị khóa học với số lượng bài học và comment
        $courseWithCounts = Course::withCount(['lessons', 'comments'])->find($course->id);

        // Test tìm lesson có tag Performance và nhiều hơn 3 comment
        $performanceLessons = Lesson::whereHas('tags', function ($query) {
            $query->where('name', 'Performance');
        })->withCount('comments')
            ->having('comments_count', '>', 3)
            ->get();

        // Test hiển thị danh sách khóa học + tổng số bài học & comment
        $coursesWithCounts = Course::withCount(['lessons', 'comments'])->get();

        $this->info('Additional tests completed successfully!');
    }
}