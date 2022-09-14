<?php

namespace App\Models;

use App\ResponseMessagesCodes;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

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
     * @throws \Exception
     */
    public function search($search): string
    {
        if (!isset($this->tvMazeApiUrl) || !isset($this->tvMazeSearchEndpoint)) {
            Log::error('Missing configuration for TVMaze API');

            return throw new \Illuminate\Http\Exceptions\HttpResponseException(
                response()->json([
                    'message' => ResponseMessagesCodes::INTERNAL_ERROR_MESSAGE,
                    'suggestion' => ResponseMessagesCodes::INTERNAL_ERROR_SUGGESTION,
                    'code' => ResponseMessagesCodes::CODE_FOUR
                ], 500)
            );
        }

        // First check if we have a cached value if so,
        // return the response without even making a request to TVMaze
        $lowerCaseSearch = strtolower($search);
        if (Cache::has($lowerCaseSearch)) {
            return Cache::get($lowerCaseSearch);
        }

        try {
            // Make GET request to TVMaze API
            $response = $this->guzzleClient->request('GET', $this->tvMazeApiUrl . $this->tvMazeSearchEndpoint, [
                'query' => [
                    'q' => $search,
                ]
            ]);
        } catch (ClientException|ConnectException|ServerException|BadResponseException|RequestException $e) {
            // Catch any exceptions and return a message that the request to TVMaze failed alongwith the error message
            return throw new \Illuminate\Http\Exceptions\HttpResponseException(
                response()->json([
                    'message' => ResponseMessagesCodes::TVMAZE_FAIL_MESSAGE,
                    'suggestion' => $e->getMessage(),
                    'code' => ResponseMessagesCodes::CODE_TWO
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
                // Cache the value for 30 minutes, this could be increased as shows are unlikely to change frequently
                Cache::put($lowerCaseSearch, $response, 1800);
            }
        }

        // If we have no match by this point, the search was unsuccessful, so we return a relevant message
        if (!$match) {
             return $this->emptyResponse();
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
}
