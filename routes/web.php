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

Route::get('/', 'WelcomeController@index')->name('welcome.index');

Route::resource('barbers', 'BarbersController');

Route::view('about', 'about.index')->name('about.index');
Route::view('contact', 'contact.index')->name('contact.index');

Auth::routes();

Route::get('walkins', 'WalkinController@index')->name('walkins.index');
Route::get('walkins/create', 'WalkinController@create')->name('walkins.create');
Route::post('walkins', 'WalkinController@store');

Route::get('worklog', 'WorklogController@index')->name('worklog.index');
Route::get('worklog/create', 'WorklogController@create')->name('worklog.create');
Route::post('worklog', 'WorklogController@startService');
