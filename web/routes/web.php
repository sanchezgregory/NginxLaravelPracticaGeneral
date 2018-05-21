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


use Illuminate\Support\Facades\DB;

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

            $updates = \App\Curse::orderBy('updated_at', 'desc')->take(5)->get();

            $contents = DB::table('curses')
                ->join('contents', 'curses.id', '=', 'contents.curse_id')
                ->select(DB::raw('count(curses.id) as cont, curses.title, curses.id'))
                ->groupBy('curses.id')
                ->orderBy('cont','desc')
                ->take(5)
                ->get();

           return view('home', compact('updates', 'contents'));

        })->name('home');

        Route::group(['middleware' => 'verified'], function() {

            Route::get('/novedades5p4', 'CourseController@index')->name('curses.index');
            Route::get('/curses', 'CurseController@index')->name('curses.index');
            Route::get('/curses/create', 'CurseController@create')->name('curses.create');
            Route::post('/curses/store', 'CurseController@store')->name('curses.store');
            Route::get('/curses/{id}/show', 'CurseController@show')->name('curses.show');
            Route::get('/curses/{curse}/edit',  'CurseController@edit')->name('curses.edit');
            Route::put('/curses/{curse}', 'CurseController@update')->name('curses.update');
            Route::delete('/curses/{curse}', 'CurseController@delete')->name('curses.delete');
            Route::post('/curses/{curse}/comments', 'CurseController@storeComment')->name('curses.storeComment');

            Route::get('/contents', 'ContentController@index')->name('contents.index');
            Route::get('/contents/{curse}/create', 'ContentController@create')->name('contents.create');
            Route::post('/contents/{curse}/store', 'ContentController@store')->name('contents.store');
            Route::get('/contents/{content}/show', 'ContentController@show')->name('contents.show');
            Route::get('/contents/{content}/edit', 'ContentController@edit')->name('contents.edit');
            Route::put('/contents/{content}', 'ContentController@update')->name('contents.update');
            Route::delete('/contents/{content}/delete', 'ContentController@delete')->name('contents.delete');
            Route::post('/contents/{content}/comments', 'ContentController@storeComment')->name('contents.storeComment');

            Route::post('/images/{content}/store', 'ImageController@store')->name('images.store');
            Route::put('/images/{image}/update', 'ImageController@update')->name('images.update');
        });
    });
});