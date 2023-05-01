<?php

namespace Tests\Feature;

use App\Click;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class ClickFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function testGetClickCount()
    {
        // Create a test click entry for today
        $click = factory(Click::class)->create();

        // Send a GET request to the /clicks endpoint
        $response = $this->json('get', '/api/clicks');

        // Assert that the response has a 200 status code
        $result = $response->assertStatus(200)->json('clicks');

        // Assert that the response contains the expected click count
        $this->assertEquals($click['id'], $result['id']);
        // Assert that database has expected record
        $this->assertDatabaseHas('clicks', [
            'id' => $result['id']
        ]);
    }

    public function testUpdateClickCount()
    {
        // Create a test click entry for today
        $click = factory(Click::class)->create();

        // Send a POST request to the /clicks endpoint
        $response = $this->json('post', '/api/clicks');

        // Assert that the response has a 201 status code and Retrieve the updated click count from the database
        $result = $response->assertStatus(201)->json('click');
        
        // Retrieve the updated click count from the database
        // $updatedClick = Click::where('date', Carbon::today())->first();

        // Assert that the click count has been incremented by 1
        $this->assertEquals($click['clicks'] + 1, $result['clicks']);
        // Assert that database has expected updated/created click record
        $this->assertDatabaseHas('clicks', [
            'id' => $result['id']
        ]);
    }
}
