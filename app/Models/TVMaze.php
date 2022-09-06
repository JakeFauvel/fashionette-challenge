<?php

namespace App\Models;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Response;

class TVMaze
{
    protected mixed $tvMazeApiUrl;
    protected mixed $tvMazeSearchEndpoint;
    protected Client $guzzleClient;
    protected string $search;

    function __construct() {
        $this->tvMazeApiUrl = env('TVMAZE_API_URL');
        $this->tvMazeSearchEndpoint = env('TVMAZE_SEARCH_ENDPOINT');
        $this->guzzleClient = new Client(['timeout' => 10]);
    }

    /**
     * @param $search
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search($search): string
    {
        try {
            // Make GET request to TVMaze API
            $response = $this->guzzleClient->request('GET', $this->tvMazeApiUrl . $this->tvMazeSearchEndpoint, [
                'query' => [
                    'q' => $search,
                ]
            ]);
        } catch (ClientException|ConnectException|ServerException|BadResponseException|RequestException $e) {
            // Catch any exceptionsa nd return a more useful message sa we do not need the
            // exception in this basic example
            return throw new \Illuminate\Http\Exceptions\HttpResponseException(
                response()->json([
                    'message' => 'TVMaze request failed',
                    'suggestion' => $e->getMessage(),
                    'code' => 2
                ], 400)
            );
        }

        // Get the body/response contents
        $response = $response->getBody()->getContents();
        // Handle the empty response case, TVMaze
        // do not return a very useful response here
        if ($response === '[]') {
            return $this->emptyResponse();
        }

        // Make into an associative array
        $responseArray = json_decode($response, true);
        $match = false;

        foreach ($responseArray as $show) {
            $lowerCaseSearch = strtolower($search);
            $lowerCaseShowResult = strtolower($show['show']['name']);

             // Check if the lowercase values match, if we have a match return the $show details
            if ($lowerCaseSearch === $lowerCaseShowResult) {
                $response = json_encode($show);
                $match = true;
            }
        }

        // If we have no match by this point, the search was unsuccessful, so we return a relevant message
        if (!$match) {
             return $this->emptyResponse($search);
        }

        return $response;
    }

    /**
     * @return string
     */
    private function emptyResponse()
    {
        return '';
    }

    /**
     * @return false|string
     */
    private function errorResponse()
    {
        return json_encode([
            'message' => 'Problem processing the request'
        ]);
    }
}
