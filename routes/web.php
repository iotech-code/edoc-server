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

    Route::resource('document', 'DocumentController');
    Route::resource('cabinet', 'CabinetController');
    Route::get('profile', 'UserController@profile')
        ->name('user.profile');
    Route::get('document/{id}/refer', 'DocumentController@getReference');
});

// Route::resource('cabinet', 'CabinetController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
