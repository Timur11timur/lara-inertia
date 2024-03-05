<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

//Route::get('/', function () {
//    return inertia('Welcome');
//});

Route::get('/welcome', function () {
    return Inertia::render('Welcome', [
        'name' => 'Some Name',
        'frameworks' => ['Laravel', 'Vue', 'Inertia'],
    ]);
});

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/users', function () {
    sleep(2);
    return Inertia::render('Users', [
        'users' => \App\Models\User::select(['id', 'name'])->paginate(10)
    ]);
});

Route::get('/settings', function () {
    return Inertia::render('Settings', [
        'time' => now()->toTimeString(),
    ]);
});

Route::post('/logout', function () {
   dd('Logging the user out');
});

Route::post('/pass-data', function () {
    dd(request('foo'));
});
