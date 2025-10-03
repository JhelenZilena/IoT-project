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

route::view('/', 'index')->name('home');
Route::get('/tabla', function () {
    return view('tabla');
})->name('tabla');
Route::get('/Registro', function () {
    return view('Registro');
})->name('Registro');
