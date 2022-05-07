<?php

namespace Tests\Feature;

use App\Models\Achievement;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LessonAchievementsTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_unlock_any_achievement()
    {
        $user = User::factory()->create();
        $achievements = Achievement::factory()
            ->count(5)
            ->create();
        $ids = $achievements->pluck('id');
        $user->unlockAchievements($ids);
        $this->assertCount(count($ids), $user->achievements);
    }

    public function test_a_user_can_unlock_first_lesson_achievement()
    {
        $user = User::factory()->create();
        $achievements = Achievement::factory()->create([
            'name' => 'First Lessons Watched',
            'points' => 1,
            'type' => 'lesson',
        ]);
        $lessons = Lesson::factory()->create();
        $user->completeLessons(1);
        $this->assertCount(1, $user->achievements);
    }

    public function test_a_user_can_unlock_5_lesson_achievement()
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()
            ->count(5)
            ->create();
        $achievement = Achievement::factory()->create([
            'name' => '5 Lessons Watched',
            'points' => 5,
            'type' => 'lesson',
        ]);
        $user->completeLessons(5);
        $this->assertCount(1, $user->achievements);
    }

    public function test_a_user_can_unlock_10_lesson_achievement()
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()
            ->count(10)
            ->create();
        $achievement = Achievement::factory()->create([
            'name' => '10 Lessons Watched',
            'points' => 10,
            'type' => 'lesson',
        ]);
        $user->completeLessons(10);
        $this->assertCount(1, $user->achievements);
    }

    public function test_a_user_can_unlock_25_lesson_achievement()
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()
            ->count(25)
            ->create();
        $achievement = Achievement::factory()->create([
            'name' => '25 Lessons Watched',
            'points' => 25,
            'type' => 'lesson',
        ]);
        $user->completeLessons(25);
        $this->assertCount(1, $user->achievements);
    }

    public function test_a_user_can_unlock_50_lesson_achievement()
    {
        $user = User::factory()->create();
        $lesson = Lesson::factory()
            ->count(50)
            ->create();
        $achievement = Achievement::factory()->create([
            'name' => '50 Lessons Watched',
            'points' => 50,
            'type' => 'lesson',
        ]);
        $user->completeLessons(50);
        $this->assertCount(1, $user->achievements);
    }
}
