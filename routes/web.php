<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])
    ->prefix("/dashboard")
    ->group(function () {
        Route::get('/', function () {
            return view('dashboard');
        })->name('dashboard.index');


        Route::get('/users', function () {
            return view('users');
        })->name('dashboard.users');
    });
