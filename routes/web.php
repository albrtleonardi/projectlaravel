<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\User\UserBookController;
use App\Http\Controllers\User\TransactionController;

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

    Route::middleware([UserMiddleware::class])
        ->prefix('user')
        ->name('user.')
        ->group(function(){
            Route::get('/dashboard', [UserBookController::class, 'dashboard'])->name('dashboard');
            Route::post('/buy/{book}', [TransactionController::class, 'buy'])->name('buy');
            Route::get('/history', [TransactionController::class, 'history'])->name('history');
        });

    Route::middleware([AdminMiddleware::class])
        ->prefix('admin')
        ->name('admin.')
        ->group(function(){
            Route::get('/dashboard', [BookController::class, 'dashboard'])->name('dashboard');
            Route::get('/books/create', [BookController::class, 'create'])->name('create');
            Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('edit');
            
            Route::post('/books', [BookController::class, 'store'])->name('store');
            Route::put('/books/{book}', [BookController::class, 'update'])->name('update');
            Route::delete('/books/{book}', [BookController::class, 'delete'])->name('destroy');
        });
});

require __DIR__.'/auth.php';
