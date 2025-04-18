<?php

use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\NotesAccessLogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



// Dashboard do utilizador comum
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); 
    })->name('dashboard');
});

//* Rotas de perfil do utilizador comum
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//* Rotas de autenticação do Admin (Apenas Login)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

//* Rotas PROTEGIDAS do Admin (Só Admins podem aceder)
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard de Admin (não precisa de log de ações)
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile/edit', [ProfileController::class, 'editAdmin'])->name('profile.edit');
    Route::get('/search', [SearchController::class, 'adminSearch'])->name('search');   
    //notificações: 
    Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications.show');
    Route::post('/notifications/update', [NotificationsController::class, 'setNotificationAsSeen'])->name('notifications.update');
    Route::delete('/notifications/{id}', [NotificationsController::class, 'destroyNotification'])->name('notifications.destroy');

    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Administração de utilizadores (Admin) com log de ações
    Route::match(['get', 'post'],'/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->middleware('logAdminActions')->name('users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::patch('/users/{user}', [AdminController::class, 'updateUser'])->middleware('logAdminActions')->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->middleware('logAdminActions')->name('users.destroy');
    
    // Administração de anotações (Admin) com log de ações
    Route::get('/notes/create', [AdminController::class, 'createNote'])->name('notes.create');
    Route::post('/notes', [AdminController::class, 'storeNote'])->middleware('logAdminActions')->name('notes.store');
    Route::get('/notes/{note}/edit', [AdminController::class, 'editNote'])->name('notes.edit');
    Route::patch('/notes/{note}', [AdminController::class, 'updateNote'])->middleware('logAdminActions')->name('notes.update');
    Route::delete('/notes/{note}', [AdminController::class, 'destroyNote'])->middleware('logAdminActions')->name('notes.destroy');

    // Administração de logs (Admin) com log de ações
    Route::delete('/logs/{log}', [AdminController::class, 'destroyLog'])->middleware('logAdminActions')->name('logs.destroy');

    // Administração de disciplinas (Admin) com log de ações
    Route::delete('/subjects/{subject}', [AdminController::class, 'destroySubject'])->middleware('logAdminActions')->name('subjects.destroy');
    Route::get('/subjects/create', [AdminController::class, 'createSubject'])->name('subjects.create');
    Route::post('/subjects', [AdminController::class, 'storeSubject'])->middleware('logAdminActions')->name('subjects.store');
    
    // Administração de pontos (Admin) com log de ações
    Route::delete('/points/{point}', [AdminController::class, 'destroyPoint'])->middleware('logAdminActions')->name('points.destroy');
});


//* ROTAS PARA USERS COMUNS (Pesquisa e Notas)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [NotesAccessLogController::class, 'index'])->name('dashboard');
    Route::get('/search', [SearchController::class, 'searchNotes'])->name('search');   
    Route::get('note/{slug}', [NotesController::class, 'show'])->name('notes.show');
    Route::post('/notes', [NotesController::class, 'storeNote'])->name('notes.store');
    Route::match(['get', 'post'],'/notes/create', [NotesController::class, 'createNote'])->name('notes.create');
    Route::delete('/notes/{note}', [NotesController::class, 'destroyNote'])->name('notes.destroy');
});

require __DIR__.'/auth.php';
