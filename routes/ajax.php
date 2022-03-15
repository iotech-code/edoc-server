<?php


Route::middleware(["web", "auth"])->group(function(){

    Route::any("user", "UserController@getAjaxUserByName")
    ->name('ajax.search_user');

    Route::get('document_refer', 'DocumentController@getReference')
    ->name('ajax.document_refer');
    
    Route::get("cabinets/{id}/folders", "CabinetController@getAjaxFolderByCabinetId");

    Route::post("feedback", "FeedBackController@sendFeedback");
    Route::post("feedback", "FeedBackController@sendFeedback");
    Route::post('online-document/save', 'OnlineDocumentController@create')
        ->name('online.create');
    Route::put('online-document/save', 'OnlineDocumentController@update')
        ->name('online.update');

    // Route::get('folder', 'CabinetController@getAjaxFolder')
    //     ->name('ajax.cabinet.folder');

} );