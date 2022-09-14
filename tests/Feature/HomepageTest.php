<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomepageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        // Very basic check the the homepage is accessible
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
