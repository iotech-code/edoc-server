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

Route::name('api.')->middleware('auth:api')->group(function(){
    
    Route::get('/user', function (Request $request) {
        return $request->user();
        // return response()->json("test");
    });
    Route::get('documents', 'DocumentApiController@getDocuments')
        ->name('document.list');
    Route::get('documents/{id}', 'DocumentApiController@getDocumentById')
        ->name('document.show');

    Route::post('documents/{document}/comment', 'DocumentApiController@comment')
        ->name('document.comment');
    Route::put('documents/{document}/respond', 'DocumentApiController@respond')
        ->name('document.respond');
    // Route::put('documents/{document}/accept', 'DocumentApiController@accept')
    //     ->name('document.accept');


});