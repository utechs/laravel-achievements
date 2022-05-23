<?php

namespace App\Models;

use App\Events\CommentWritten;
use App\Events\LessonWatched;
use App\Models\Comment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\Achieve;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Achieve;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The comments that belong to the user.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * The lessons that a user has access to.
     */
    public function lessons()
    {
        return $this->belongsToMany(Lesson::class);
    }

    /**
     * The lessons that a user has watched.
     */
    public function watched()
    {
        return $this->belongsToMany(Lesson::class)->wherePivot('watched', true);
    }

    /**
     * The achievements that a user has unlocked.
     */
    public function achievements()
    {
        return $this->belongsToMany(Achievement::class)->withTimeStamps();
    }

    /**
     * The badges that a user has unlocked.
     */
    public function badges()
    {
        return $this->belongsToMany(Badge::class)->withTimeStamps();
    }

    /**
     * this methods for testing purposes
     * delete them before deploy to production.
     */

    public function completeLessons($count)
    {
        for ($i = 1; $i <= $size; $i++) {
            $lesson = Lesson::findOrFail($i);
            $this->lessons()->attach($lesson->id, [
                'watched' => 1,
            ]);
            LessonWatched::dispatch($lesson, $this);
        }
    }

    public function addComments($count)
    {
        for ($i = 1; $i <= $size; $i++) {
            $comment = Comment::factory()->create(['user_id' => $this->id]);
            CommentWritten::dispatch($comment);
        }
    }
}
