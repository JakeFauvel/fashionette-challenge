<?php

namespace App;

class ResponseMessagesCodes
{
    // Response codes
    const CODE_ONE = 1;
    const CODE_TWO = 2;
    const CODE_THREE = 3;
    const CODE_FOUR = 4;

    // Response messages
    // const GENERAL_ERROR_MESSAGE = 'Problem processing the request';
    const UNSUPPORTED_CALL_OR_QUERY_MESSAGE = 'API call not found/supported';
    const EMPTY_SEARCH_MESSAGE = 'Empty response for search ';
    const TVMAZE_FAIL_MESSAGE = 'TVMaze request failed';
    const INVALID_QUERY_PARAM_MESSAGE = 'Failed request, invalid query paramter';
    const INTERNAL_ERROR_MESSAGE = 'Internal error';

    // Suggestion messages
    const API_FAIL = 'Try /search with a valid query parameter for example /search?q=deadwood. This is the only supported call in this challenge';
    const EMPTY_RESPONSE_SUGGESTION = 'The query returned no results, the search is exact. Check the spelling of the show';
    CONST QUERY_PARAM_SUGGESTION = 'This request expects a single query parameter (q). For example http://0.0.0.0/api/search?q=example';
    CONST INTERNAL_ERROR_SUGGESTION = 'There was an error processing the request, the development team has been notified';
}
