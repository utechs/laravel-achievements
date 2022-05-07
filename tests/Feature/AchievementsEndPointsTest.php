<?php

namespace Tests\Feature;

use App\Models\Achievement;
use App\Models\Badge;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AchievementsEndPointsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_create_achievement()
    {
        $response = $this->post('/achievements', [
            'name' => 'test achievement',
            'description' => 'test description',
            'type' => 'lesson',
            'points' => 1,
        ]);

        $response->assertStatus(201);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_achievements_endpoint()
    {
        $user = User::factory()->create();
        $response = $this->get("/users/{$user->id}/achievements");
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_achievements_endpoint_with_data()
    {
        $user = User::factory()->create();
        Lesson::factory()
            ->count(50)
            ->create();
        Achievement::factory()
            ->count(10)
            ->create();
        Badge::factory()
            ->count(4)
            ->create();
        $user->completeLessons(10);
        $user->addComments(5);
        $this->assertCount(6, $user->achievements);
        $this->assertCount(2, $user->badges);
        $response = $this->get("/users/{$user->id}/achievements");
        $response->assertStatus(200);
    }
}
