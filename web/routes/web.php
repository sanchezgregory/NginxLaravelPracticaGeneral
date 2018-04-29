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


Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {

        return view('welcome');

    });

    // Auth::routes();

    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
    Route::get('confirmation/{token}', 'Auth\RegisterController@getConfirmation')->name('confirmation');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::middleware(['auth'])->group(function () {

        Route::get('/home', function() {

           return view('home');

        })->name('home');

        Route::group(['middleware' => 'verified'], function() {

            Route::get('/novedades5p4', 'CourseController@index')->name('curses.index');
            Route::get('/curses', 'CurseController@index')->name('curses.index');
            Route::get('/curses/create', 'CurseController@create')->name('curses.create');
            Route::post('/curses/store', 'CurseController@store')->name('curses.store');
            Route::get('/curses/{id}/show', 'CurseController@show')->name('curses.show');

            Route::get('/contents', 'ContentController@index')->name('contents.index');
            Route::get('/contents/{curse}/create', 'ContentController@create')->name('contents.create');
            Route::post('/contents/{curse}/store', 'ContentController@store')->name('contents.store');
            Route::get('/contents/{content}/show', 'ContentController@show')->name('contents.show');
        });
    });
});