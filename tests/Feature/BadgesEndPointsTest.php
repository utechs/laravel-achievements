<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BadgesEndPointsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test__can_create_new_badge()
    {
        $response = $this->post('/badges', [
            'name' => 'First Badge',
            'points' => 0,
        ]);

        $response->assertStatus(201);
    }
}
