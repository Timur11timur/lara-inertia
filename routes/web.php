<?php

use App\Models\User;
use Illuminate\Support\Facades\Request;
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
//    sleep(2);
    return Inertia::render('Users/Index', [
        'users' => User::select(['id', 'name'])
            ->when(Request::input('search'), function ($q, $search) {
                $q->where('name', 'like', '%' . $search . '%');
            })
            ->paginate(10)
            ->withQueryString(),
        'filters' => Request::only(['search']),
    ]);
});

Route::get('/users/create', function () {
    return Inertia::render('Users/Create');
});

Route::post('/users', function () {
    $attributes = Request::validate([
        'name' => 'required',
        'email' => 'required|email|unique:Users,email',
        'password' => 'required',
    ]);

    User::create($attributes);

    return redirect('/users');
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
