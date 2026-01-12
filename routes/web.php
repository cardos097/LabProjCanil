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
use App\Http\Controllers\ComprovativoController;
use App\Http\Controllers\UserController;

// Admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminAnimalController;
use App\Http\Controllers\Admin\AdminAdoptionController;
use App\Http\Controllers\Admin\AdminMessageController;
use App\Http\Controllers\Admin\AdminSuccessStoryController;
use App\Http\Controllers\Admin\AdminVolunteerController;

/*
|--------------------------------------------------------------------------
| Public pages
|--------------------------------------------------------------------------
*/

Route::view('/', 'home')->name('home');

// Animais (público)
Route::get('/animals', [AnimalController::class, 'index'])->name('animals.index');
Route::get('/animals/{animal}', [AnimalController::class, 'show'])->name('animals.show');

// Success stories (public)
Route::get('/success-stories', [SuccessStoryController::class, 'index'])->name('success_stories.index');

// Contacto (público)
Route::view('/contact', 'contact')->name('contact');
Route::post('/contact', [MessageController::class, 'store'])->name('messages.store');

// Perfil do usuário (autenticado)
Route::middleware('auth')->group(function () {
    Route::get('/perfil', [UserController::class, 'profile'])->name('profile');
});

// Doações (Stripe) — público
Route::get('/doar', [DonationController::class, 'form'])->name('donations.form');
Route::post('/doar/checkout', [DonationController::class, 'checkout'])->name('donations.checkout');
Route::get('/doar/sucesso', [DonationController::class, 'success'])->name('donations.success');
Route::get('/doar/cancelado', [DonationController::class, 'cancel'])->name('donations.cancel');

// Public route to download the comprovativo PDF (uses payment intent id)
Route::get('/comprovativo/{paymentId}', [ComprovativoController::class, 'gerarComprovativo'])
    ->name('comprovativo.download');

/*
|--------------------------------------------------------------------------
| Auth-only (requires login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard (Breeze)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    // Profile (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Comentários
    Route::post('/animals/{animal}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Pedido de adoção (user)
    Route::post('/animals/{animal}/adopt', [AdoptionController::class, 'store'])->name('adoptions.store');

    // Voluntários
    Route::get('/volunteer', [VolunteerController::class, 'create'])->name('volunteers.create');
    Route::post('/volunteer', [VolunteerController::class, 'store'])->name('volunteers.store');
});

/*
|--------------------------------------------------------------------------
| Admin (requires login + role:admin)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Admin dashboard
        Route::get('/', [AdminController::class, 'index'])->name('index');

        // Admin CRUD Animais
        Route::resource('animals', AdminAnimalController::class);

        // Admin: Adoções
        Route::get('/adoptions', [AdminAdoptionController::class, 'index'])->name('adoptions.index');
        Route::patch('/adoptions/{adoption}/approve', [AdoptionController::class, 'approve'])->name('adoptions.approve');
        Route::patch('/adoptions/{adoption}/reject', [AdoptionController::class, 'reject'])->name('adoptions.reject');

        // Admin: Voluntários
        Route::get('/volunteers', [AdminVolunteerController::class, 'index'])->name('volunteers.index');
        Route::patch('/volunteers/{volunteer}/approve', [AdminVolunteerController::class, 'approve'])->name('volunteers.approve');
        Route::patch('/volunteers/{volunteer}/reject', [AdminVolunteerController::class, 'reject'])->name('volunteers.reject');

        // Admin: Mensagens (Contacte-nos)
        Route::get('/messages', [AdminMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [AdminMessageController::class, 'show'])->name('messages.show');
        Route::delete('/messages/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');

        // Admin: Histórias de Sucesso
        Route::get('/success-stories', [AdminSuccessStoryController::class, 'index'])->name('stories.index');
        Route::get('/success-stories/create', [AdminSuccessStoryController::class, 'create'])->name('stories.create');
        Route::post('/success-stories', [AdminSuccessStoryController::class, 'store'])->name('stories.store');
        Route::get('/success-stories/{story}', [AdminSuccessStoryController::class, 'show'])->name('stories.show');
        Route::get('/success-stories/{story}/edit', [AdminSuccessStoryController::class, 'edit'])->name('stories.edit');
        Route::put('/success-stories/{story}', [AdminSuccessStoryController::class, 'update'])->name('stories.update');
        Route::delete('/success-stories/{story}', [AdminSuccessStoryController::class, 'destroy'])->name('stories.destroy');

        // Nova rota para gerar o comprovativo em PDF
        Route::get('/comprovativo/{paymentId}', [ComprovativoController::class, 'gerarComprovativo'])->name('comprovativo.generate');
    });

/*
|--------------------------------------------------------------------------
| Auth routes (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
