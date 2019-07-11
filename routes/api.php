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

Route::group(
    [
        'name' => 'api.',
        'middleware' => 'auth:api'
    ],
    function(){
    
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // use for verify pass user
    Route::post('pass_verify', function(Request $request){
        $user = auth()->user() ;
        if ( !is_null( $user ) ) {
            if( Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => true,
                    'message' => 'ยืนยันตนสำเร็จ'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'ยืนยันตนไม่สำเร็จ'
                ]);
            }
        } else {
            return response()->json(null, 404);
        }
    });
    // Get documents list
    Route::get('documents', 'DocumentApiController@getDocuments')
        ->name('document.list');

    // Get documents by id
    Route::get('documents/{id}', 'DocumentApiController@getDocumentById')
        ->name('document.show');

    Route::post('documents/{document}/comment', 'DocumentApiController@comment')
        ->name('document.comment');
    Route::put('documents/{document}/respond', 'DocumentApiController@respond')
        ->name('document.respond');

});