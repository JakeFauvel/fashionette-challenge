<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use Illuminate\Http\Response;

class SearchController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(SearchRequest $request)
    {
        return response()->json([
            'message' => 'Successful request',
        ], 200);
    }
}
