<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdoptionController;

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
    Route::post('/animals/{animal}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('animals/{animal}/adopt', [AdoptionController::class, 'store'])->name('adoptions.store');
});

Route::middleware('auth')->group(function () {
    Route::patch('/adptions/{adoption}/approve', [AdoptionController::class, 'approve'])->name('adoptions.approve');
    Route::patch('/adptions/{adoption}/reject', [AdoptionController::class, 'reject'])->name('adoptions.reject');
});

Route::post('/contact', [MessageController::class, 'store'])->name('messages.store');

Route::view('/contact', 'contact')->name('contact');

require __DIR__.'/auth.php';
