<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\NotesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard'); 
})->middleware(['auth', 'verified'])->name('dashboard');

// Rotas de autenticação (usuário comum)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//* Admin 
Route::prefix('admin')->name('admin.')->group(function () {
    // Rota para o login do admin
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    
    // Rota de logout do admin
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    
    // Rota para o dashboard do admin (sem middleware, pois a role será verificada no controlador)
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Administração de utilizadores (Admin)
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::patch('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    
    // Administração de anotações (Admin)
    Route::get('/notes/create', [AdminController::class, 'createNote'])->name('notes.create');
    Route::post('/notes', [AdminController::class, 'storeNote'])->name('notes.store');
    Route::get('/notes/{note}/edit', [AdminController::class, 'editNote'])->name('notes.edit');
    Route::patch('/notes/{note}', [AdminController::class, 'updateNote'])->name('notes.update');
    Route::delete('/notes/{note}', [AdminController::class, 'destroyNote'])->name('notes.destroy');
});
//* ROTAS PARA PESQUISA E NOTA INDIVIDUAL (para usuários comuns)
Route::middleware('auth')->group(function () {
    Route::get('/search', [SearchController::class, 'searchNotes'])->name('search');    
    Route::get('note/{slug}', [NotesController::class, 'show'])->name('notes.show');
    
    Route::post('/notes', [NotesController::class, 'storeNote'])->name('notes.store');
    Route::match(['get', 'post'],'/notes/create', [NotesController::class, 'createNote'])->name('notes.create');
    
    Route::delete('/notes/{note}', [NotesController::class, 'destroyNote'])->name('notes.destroy');
});

// Rotas de autenticação (usuário comum)
require __DIR__.'/auth.php';
