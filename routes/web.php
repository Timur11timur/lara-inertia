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
            'users' => User::select(['id', 'name', 'is_admin'])
                ->when(Request::input('search'), function ($q, $search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })
                ->orderBy('id', 'Desc')
                ->paginate(10)
                ->withQueryString()
                ->through(fn($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'is_admin' => $user->is_admin,
                    'can' => [
                        'edit' => auth()->user()->can('edit', $user)
                        ],
                ]),
            'filters' => Request::only(['search']),
            'can' => [
                'createUser' => auth()->user()->can('create', User::class),
            ],
        ]);
    });

    Route::get('/users/create', function () {
        return Inertia::render('Users/Create');
    })->can('create', User::class);

    Route::post('/users', function () {
        $attributes = Request::validate([
            'name' => 'required',
            'email' => 'required|email|unique:Users,email',
            'password' => 'required',
            'is_admin' => 'required|boolean',
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

