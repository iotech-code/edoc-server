<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    // return redirect('/document');
    return redirect("/document");
});

Route::middleware(['web','auth'])->group(function(){

    // document
    Route::resource('document', 'DocumentController');
    Route::get('document/inbox', 'DocumentController@inbox');
    Route::get('document/sentbox', 'DocumentController@sentbox');
    Route::get('doc/test', function(){
        return Request::all();
    });
    
    Route::post('document/{document}/comment', 'DocumentController@comment')
        ->name('document.comment');

    Route::put('document/{document}/respond', 'DocumentController@respond')
        ->name('document.respond');


    // Route::put('document/{docuemnt}/reply', 'DocumentController@reply')
    //     ->name('document.reply');
    // Route::get('document/{docuemnt}/reply/create', 'DocumentController@createReply')
    //     ->name('document.reply.crate');
    // Route::post('document/{docuemnt}/reply', 'DocumentController@createReply')
    //     ->name('document.reply.store');
    // Route::put('document/{document}/assign', 'DocumentController@assign')
    //     ->name('document.assign');
    // Route::put('document/{document}/acknowledge', 'DocumentController@acknowledge')
    //     ->name('document.acknowledge');

    // cabinet
    Route::resource('cabinet', 'CabinetController');

    // cabinet
    Route::get('cabinet/{cabinet}/permission', 'CabinetController@permission')
        ->name('cabinet.permission.index');
    Route::put('cabinet/{cabinet}/permission', 'CabinetController@updatePermission')
        ->name('cabinet.permission.update');

    // folder
    Route::get('cabinet/{cabinet_id}/folder', 'CabinetController@indexFolder')
        ->name('cabinet.folder.index');
    Route::post('cabinet/{cabinet}/folder', 'CabinetController@storeFolder')
        ->name('cabinet.folder.store');
    Route::get('cabinet/{cabinet_id}/folder/create', 'CabinetController@createFolder')
        ->name('cabinet.folder.create');
    Route::put('cabinet/folder/{folder_id}', 'CabinetController@updateFolder')
        ->name('cabinet.folder.update');
    Route::get('cabinet/folder/{folder}/edit', 'CabinetController@editFolder')
        ->name('cabinet.folder.edit');

    // Route::resource('folder', 'FolderController');
    Route::resource('officer', 'OfficerController');
    Route::post('officer/import', 'OfficerController@import')
        ->name("officer.import");
    Route::get('officer/download/template', function(){
        return response()->download(
            storage_path("import-template.csv")
        );
    });
    // user profile
    Route::get('profile', 'UserController@edit')
        ->name('user.profile');
    Route::put('profile', 'UserController@update')
        ->name('user.update');

    Route::get('dashboard', 'DashBoardController@index');
});

// donload file
Route::get('file/{prefix}/{id}', 'FileController@downloadFile')
    ->name('attachment.download');

// Route::resource('cabinet', 'CabinetController');

Auth::routes();

Route::get('/home', function(){
    return redirect('/');
});
