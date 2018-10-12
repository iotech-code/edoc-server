<?php

Route::post('/login', 'LoginController@login')
    ->name('back-office.login.post');
Route::get('/login', 'LoginController@showLoginForm')
->name('back-office.loginForm');

Route::match(['get', 'post'],'/logout', 'LoginController@logout');

Route::get('/', function(){
    return redirect('/back-office/login');
});

Route::group([
    'middleware' => ['seller'],
    'as' => 'back-office.',
],
function(){
    Route::resource('school', 'SchoolController');
});