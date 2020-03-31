<?php

use Illuminate\Support\Facades\Route;

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
// Gli utenti non loggati verranno indirizzato in questa pagina
Route::get('/', function () {
    return view('guest.welcome');
});

Auth::routes();

Route::get('/posts', 'PostController@index')->name('posts.index');
// Creo una rotta al post specifico grazie a show
Route::get('/posts/{slug}', 'PostController@show')->name('posts.show');
// Creo una rotta per comment con la funzione store e controller comment

Route::post('/comments/create', 'CommentController@store')->name('comments.store');


Route::get('/home', 'HomeController@index')->name('home');

Route::name('admin.')->prefix('admin')->namespace('Admin')->middleware('auth')->group(function () {
    // Inserisco le varie rotte in admin
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('posts', 'PostController');

});