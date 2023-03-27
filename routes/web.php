<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GrupoController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\ProyectController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AuditoriaController;

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
    // return view('welcome');
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::group(['middleware' => ['auth', 'permission']], function() {

        Route::resource('category', CategoryController::class);
        Route::resource('proyect', ProyectController::class);
        Route::resource('group', GrupoController::class);
        Route::resource('users', UserController::class);
        Route::resource('roles', RolesController::class);
        Route::resource('auditorias', AuditoriaController::class);
    });
});


