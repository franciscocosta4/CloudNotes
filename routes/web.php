<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
use App\Http\Controllers\Admin\AuthController;


use App\Http\Controllers\AdminController;
Route::prefix('admin')->name('admin.')->group(function () {
    // Login e Logout
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Rotas protegidas por auth:admin
    Route::middleware('auth:admin')->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        //? Administração de utilizadores
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::patch('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');

        //? Administração de anotações
        Route::get('/notes/create', [AdminController::class, 'createNote'])->name('notes.create');
        Route::post('/notes', [AdminController::class, 'storeNote'])->name('notes.store');
        Route::get('/notes/{note}/edit', [AdminController::class, 'editNote'])->name('notes.edit');
        Route::patch('/notes/{note}', [AdminController::class, 'updateNote'])->name('notes.update');
        Route::delete('/notes/{note}', [AdminController::class, 'destroyNote'])->name('notes.destroy');
    });
});


require __DIR__.'/auth.php';
