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

Route::get('barbers', 'BarbersController@index')->name('barbers.index');
Route::get('barbers/{id}', 'BarbersController@show')->name('barbers.show');
Route::get('barbers/create', 'BarbersController@create')->name('barbers.create');

Route::get('queue', 'QueueController@index')->name('queue.index');

Route::view('about', 'about.index')->name('about.index');
Route::view('contact', 'contact.index')->name('contact.index');