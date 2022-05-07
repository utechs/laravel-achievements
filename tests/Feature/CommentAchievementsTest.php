<?php

namespace Tests\Feature;

use App\Models\Achievement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentAchievementsTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_unlock_first_comment_achievement()
    {
        $user = User::factory()->create();
        $achievements = Achievement::factory()->create([
            'name' => 'First Comments Watched',
            'points' => 1,
            'type' => 'comment',
        ]);
        $user->addComments(1);
        $this->assertCount(1, $user->achievements);
    }

    public function test_a_user_can_unlock_3_comment_achievement()
    {
        $user = User::factory()->create();
        $achievement = Achievement::factory()->create([
            'name' => '3 Comments Watched',
            'points' => 3,
            'type' => 'comment',
        ]);
        $user->addComments(3);
        $this->assertCount(1, $user->achievements);
    }

    public function test_a_user_can_unlock_5_comment_achievement()
    {
        $user = User::factory()->create();
        $achievement = Achievement::factory()->create([
            'name' => '5 Comments Watched',
            'points' => 5,
            'type' => 'comment',
        ]);
        $user->addComments(5);
        $this->assertCount(1, $user->achievements);
    }

    public function test_a_user_can_unlock_10_comment_achievement()
    {
        $user = User::factory()->create();
        $achievement = Achievement::factory()->create([
            'name' => '10 Comments Watched',
            'points' => 10,
            'type' => 'comment',
        ]);
        $user->addComments(10);
        $this->assertCount(1, $user->achievements);
    }

    public function test_a_user_can_unlock_20_comment_achievement()
    {
        $user = User::factory()->create();
        $achievement = Achievement::factory()->create([
            'name' => '20 Comments Watched',
            'points' => 20,
            'type' => 'comment',
        ]);
        $user->addComments(20);
        $this->assertCount(1, $user->achievements);
    }
}
