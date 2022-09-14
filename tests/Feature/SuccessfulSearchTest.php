<?php

namespace Tests\Feature;

use Tests\TestCase;

class SuccessfulSearchTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_success_tvmaze_api_search_request()
    {
        $searchTerm = 'deadwood';
        $response = $this->get('/api/search?q=' . $searchTerm);
        // Bail early if we do not receive a 200 response statusCode
        if ($response->getStatusCode() !== 200) {
            $this->fail('Expected 200 response, received response statusCode: ' . $response->getStatusCode());
        }
        $responseArray = json_decode($response->getContent(), true);

        // Once we have a 200 response, check we have the showData
        if ($response->status() == 200 && isset($responseArray['showData'])) {
            // Check if we have a match with the show name
            if ($responseArray['showData'] && strtolower($responseArray['showData']['show']['name']) == $searchTerm) {
                $response->assertStatus(200);
            } else {
                // We do not have a match, show a failure message
                $this->fail('Search failure/mismatch for search [' . $searchTerm . ']');
            }
        } else {
            // Handle all other cases where we do not get the correct response
            $this->fail('Search failed for [' . $searchTerm . ']');
        }
    }
}
