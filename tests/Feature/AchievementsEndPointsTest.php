<?php

namespace Tests\Feature;

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
}
