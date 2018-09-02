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
    Route::put('document/{document}/assign', 'DocumentController@assign')
        ->name('document.assign');
    
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
    
    // user profile
    Route::get('profile', 'UserController@edit')
        ->name('user.profile');
    Route::put('profile', 'UserController@update')
        ->name('user.update');

    
});

// donload file
Route::get('file/{token}', 'FileController@downloadFile')
    ->name('attachment.download');

// Route::resource('cabinet', 'CabinetController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
