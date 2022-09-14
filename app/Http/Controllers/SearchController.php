<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\TVMaze;
use App\ResponseMessagesCodes;

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
                'message' => ResponseMessagesCodes::EMPTY_SEARCH_MESSAGE . '[' . $searchTerm . ']',
                'suggestion' => ResponseMessagesCodes::EMPTY_RESPONSE_SUGGESTION,
                'showData' => [],
            ];
        }

        return [
            'searchTerm' => $searchTerm,
            'showData' => json_decode($searchData)
        ];
    }
}
