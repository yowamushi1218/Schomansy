<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomController;


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
    return view('login');
});


//Login-Register
Route::post('/login', 'CustomController@login')->name('login');
Route::post('/register', 'CustomController@register')->name('register');

//Dashboard
Route::post('home',[CustomController::class,'welcome']);
Route::get('home', [CustomController::class, 'welcome'])->name('home');
Route::get('/manage', [CustomController::class, 'manage'])->name('manage');



