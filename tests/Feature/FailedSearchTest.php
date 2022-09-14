<?php

namespace Tests\Feature;

use App\ResponseMessagesCodes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FailedSearchTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_failed_query_param()
    {
        $searchTerm = 'deadwood';
        $response = $this->get('/api/search?qs=' . $searchTerm);
        // We expect a 400 response for this request, so we can bail early if we receive anything other than
        // a 404 response statusCode
        if ($response->getStatusCode() !== 400) {
            $this->fail('Expected 400 response, received response statusCode: ' . $response->getStatusCode());
        }

        // Once we have a response, decode it and search the array for the relevant message/suggestion
        $responseArray = json_decode($response->getContent(), true);
        if ($responseArray['message'] == ResponseMessagesCodes::INVALID_QUERY_PARAM_MESSAGE && $responseArray['suggestion'] == ResponseMessagesCodes::QUERY_PARAM_SUGGESTION) {
            $response->assertStatus(400);
        } else {
            // Handle all cases where we did not receive the right message/suggestion
            $this->fail('Invalid message/suggestion received for this API failure');
        }
    }
}
