<?php

use Illuminate\Http\Request;

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

Route::post('login', 'UserApiController@login');
Route::any('logout', 'UserApiController@logout');

Route::middleware('auth:api')->group(function(){
    
    Route::get('/user', function (Request $request) {
        return $request->user();
        // return response()->json("test");
    });
    Route::get('documents', 'DocumentApiController@getDocuments');
    Route::post('documents/{document}/reply', 'DocumentApiController@createReplyDocument');
    Route::post('documents/{document}', 'DocumentApiController@approveDocument');
});
