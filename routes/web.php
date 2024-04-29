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

//view routes - without auth
Route::get('/login', function () {
    return view('login', [
        'authMessage' => null
    ]);
})->name('login');

Route::get('/register', function () {
    return view('register', [
        'authMessage' => null
    ]);
})->name('register');

//index route
Route::get('/', [\App\Http\Controllers\AuthController::class, 'index']);

//route requesting auth
Route::group(['middleware' => \App\Http\Middleware\AuthMiddleware::class], function () {
   Route::get('dashboard', function (){
      return view('dashboard');
   })->name('user.dashboard');
});

//authentication routes, prefixed by 'auth', handled by AuthController
Route::group(['prefix' => 'auth', 'controller' => \App\Http\Controllers\AuthController::class], function () {

    //handle valid login request
    Route::post('/login', ['uses' => 'login'])->name('auth.login');
    //for GET requests, to reject when opened by URL only - invalid login request
    Route::get('/login', function () {
        return redirect(route('login', [
            'redirect' => "Invalid login"
        ]));
    });

    //handle valid registration request
    Route::post('/register', ['uses' => 'register'])->name('auth.register');
    //for GET requests, to reject when opened by URL only - invalid register request
    Route::get('/register', function () {
        return redirect(route('register', [
            'redirect' => "Invalid register"
        ]));
    });

    //handle valid logout request
    Route::get('/logout', ['uses' => 'logout'])->name('auth.logout');
});

