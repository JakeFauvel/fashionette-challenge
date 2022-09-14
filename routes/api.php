<?php

use App\ResponseMessagesCodes;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/search', [\App\Http\Controllers\SearchController::class, 'search']);

// Basic handling of any unsupported API calls
Route::any('{path}', function() {
    return response()->json([
        'message' => ResponseMessagesCodes::UNSUPPORTED_CALL_OR_QUERY_MESSAGE,
        'suggestion' => ResponseMessagesCodes::API_FAIL,
        'code' => ResponseMessagesCodes::CODE_THREE
    ], 404);
})->where('path', '.*');
