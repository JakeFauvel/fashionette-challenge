<?php

namespace Tests\Feature;

use App\ResponseMessagesCodes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IncorrectApiEndpointTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_incorrect_api_endpoint()
    {
        $searchTerm = 'deadwood';
        $response = $this->get('/api/searcheySearch?q=' . $searchTerm);
        // We expect a 404 here so bail early if the response is not a 404 statusCode
        if ($response->getStatusCode() !== 404) {
            $this->fail('Expected 404 response, received response statusCode: ' . $response->getStatusCode());
        }
        $responseArray = json_decode($response->getContent(), true);

        // Check the response for the correct message/suggestion
        if ($responseArray['message'] == ResponseMessagesCodes::UNSUPPORTED_CALL_OR_QUERY_MESSAGE && $responseArray['suggestion'] == ResponseMessagesCodes::API_FAIL) {
            $response->assertStatus(404);
        } else {
            // Handle all other cases where the message/suggestion is not what we expect
            $this->fail('Invalid message/suggestion received for this API failure');
        }
    }
}
