<?php

namespace Tests\Feature;

use App\ResponseMessagesCodes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchNoResultsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $searchTerm = 'asdad daslsa lsd aasd skad akds ak';
        $response = $this->get('/api/search?q=' . $searchTerm);
        // We expect a 200 response even though the search by return no results
        if ($response->getStatusCode() !== 200) {
            $this->fail('Expected 200 response, received response statusCode: ' . $response->getStatusCode());
        }
        // Decode the response and check for a formattted message and a suggestion
        $responseArray = json_decode($response->getContent(), true);
        if ($responseArray['message'] == ResponseMessagesCodes::EMPTY_SEARCH_MESSAGE . '[' . $searchTerm . ']' && $responseArray['suggestion'] == ResponseMessagesCodes::EMPTY_RESPONSE_SUGGESTION) {
            $response->assertStatus(200);
        } else {
            // Handle all other cases where we get a response we do not expect
            $this->fail('Invalid message/suggestion received for this API failure');
        }
    }
}
