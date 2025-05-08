<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Course extends Model
{
    protected $fillable = ['title', 'description', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function scopePopular($query)
    {
        return $query->withCount('lessons')
            ->having('lessons_count', '>=', 5);
    }

    public function scopeWithInstructor($query, $instructorId)
    {
        return $query->where('user_id', $instructorId);
    }
}