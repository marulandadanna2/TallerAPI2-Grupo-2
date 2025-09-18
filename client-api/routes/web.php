<?php

use App\Http\Controllers\UsersController;
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

Route::prefix('users')->group(function(){
    Route::get('/index', [UsersController::class, 'index'])-> name('users.index');
    Route::get('/create', [UsersController::class, 'create'])-> name('users.create');
    Route::get('/edit/{id}', [UsersController::class, 'edit'])-> name('users.edit');
    Route::post('/store', [UsersController::class, 'store'])-> name('users.store');
    Route::put('/update/{id}', [UsersController::class, 'update'])-> name('users.update');
    Route::delete('/destroy/{id}', [UsersController::class, 'destroy'])-> name('users.destroy');
});