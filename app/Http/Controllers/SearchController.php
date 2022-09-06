<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\TVMaze;

class SearchController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(SearchRequest $request)
    {
        $searchTerm = $request->q;
        /** @var TVMaze $tvMazeSearch */
        $tvMazeSearch = (new TVMaze())->search($searchTerm);
        $responseData = $this->formatResponseData($searchTerm, $tvMazeSearch);

        return response()->json($responseData);
    }

    private function formatResponseData($searchTerm, $searchData)
    {
        if ($searchData == '') {
            return [
                'searchTerm' => $searchTerm,
                'message' => 'Empty response for search [' . $searchTerm . ']',
                'suggestion' => 'The query returned no results, the search is exact. Check the spelling of the show',
                'showData' => [],
            ];
        }

        return [
            'searchTerm' => $searchTerm,
            'showData' => json_decode($searchData)
        ];
    }
}
