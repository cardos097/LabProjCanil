<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\SuccessStoryController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\DonationController;

// Admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminAnimalController;

/*
|--------------------------------------------------------------------------
| Public pages
|--------------------------------------------------------------------------
*/

Route::view('/', 'home')->name('home');

// Animais (público)
Route::get('/animals', [AnimalController::class, 'index'])->name('animals.index');
Route::get('/animals/{animal}', [AnimalController::class, 'show'])->name('animals.show');

// Success stories (público)
Route::get('/success-stories', [SuccessStoryController::class, 'index'])->name('success_stories.index');

// Contacto (público)
Route::view('/contact', 'contact')->name('contact');
Route::post('/contact', [MessageController::class, 'store'])->name('messages.store');

// Doações (Stripe)
Route::get('/doar', [DonationController::class, 'form'])->name('donations.form');
Route::post('/doar/checkout', [DonationController::class, 'checkout'])->name('donations.checkout');
Route::get('/doar/sucesso', [DonationController::class, 'success'])->name('donations.success');
Route::get('/doar/cancelado', [DonationController::class, 'cancel'])->name('donations.cancel');

/*
|--------------------------------------------------------------------------
| Auth-only (requires login)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Comentários
    Route::post('/animals/{animal}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Adoções
    Route::post('/animals/{animal}/adopt', [AdoptionController::class, 'store'])->name('adoptions.store');

    // Aprovar / Rejeitar adoções (controller verifica admin)
    Route::patch('/adoptions/{adoption}/approve', [AdoptionController::class, 'approve'])->name('adoptions.approve');
    Route::patch('/adoptions/{adoption}/reject', [AdoptionController::class, 'reject'])->name('adoptions.reject');

    // Voluntários
    Route::get('/volunteer', [VolunteerController::class, 'create'])->name('volunteers.create');
    Route::post('/volunteer', [VolunteerController::class, 'store'])->name('volunteers.store');
});

/*
|--------------------------------------------------------------------------
| Admin (requires login + role:admin)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // Admin CRUD Animais
    Route::resource('animals', AdminAnimalController::class);
});

/*
|--------------------------------------------------------------------------
| Auth routes (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
