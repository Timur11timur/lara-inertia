<?php

use App\Http\Controllers\Auth\LoginController;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//Route::get('/', function () {
//    return inertia('Welcome');
//});

Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth');

Route::middleware(['auth'])->group(function () {
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

    Route::post('/pass-data', function () {
        dd(request('foo'));
    });
});

