<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalityController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepresentationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



// Route vers la page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home.index');

// Page Home pour les utilisateurs authentifiés
Route::get('/', [HomeController::class, 'index'])->middleware(['auth'])->name('home.index');
Route::get('/search', [HomeController::class, 'search'])->name('home.search');

// Routes Artist
Route::get('/artist', [ArtistController::class, 'index'])->name('artist.index');
Route::get('/artist/{id}', [ArtistController::class, 'show'])->where('id', '[0-9]+')->name('artist.show');
Route::get('/artist/edit/{id}', [ArtistController::class, 'edit'])->where('id', '[0-9]+')->name('artist.edit');
Route::put('/artist/{id}', [ArtistController::class, 'update'])->where('id', '[0-9]+')->name('artist.update');
Route::get('/artist/create', [ArtistController::class, 'create'])->name('artist.create');
Route::post('/artist', [ArtistController::class, 'store'])->name('artist.store');
Route::delete('/artist/{id}', [ArtistController::class, 'destroy'])->where('id', '[0-9]+')->name('artist.delete');

// Routes Type
Route::get('/type', [TypeController::class, 'index'])->name('type.index');
Route::get('/type/{id}', [TypeController::class, 'show'])->where('id', '[0-9]+')->name('type.show');

// Routes Locality
Route::get('/locality', [LocalityController::class, 'index'])->name('locality_index');
Route::get('/locality/{id}', [LocalityController::class, 'show'])->where('id', '[0-9]+')->name('locality_show');

// Routes Role
Route::get('/role', [RoleController::class, 'index'])->name('role_index');
Route::get('/role/{id}', [RoleController::class, 'show'])->where('id', '[0-9]+')->name('role_show');

// Routes Location
Route::get('/location', [LocationController::class, 'index'])->name('location_index');
Route::get('/location/{id}', [LocationController::class, 'show'])->where('id', '[0-9]+')->name('location_show');

// Routes Show
Route::get('/show', [ShowController::class, 'index'])->name('show.index');
Route::get('/show/{id}', [ShowController::class, 'show'])->where('id', '[0-9]+')->name('show.show');

// Routes Representation
Route::get('/representation', [RepresentationController::class, 'index'])->name('representation_index');
Route::get('/representation/{id}', [RepresentationController::class, 'show'])->where('id', '[0-9]+')->name('representation_show');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::feeds();


// Routes Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation.index');
    Route::get('/reservation/create', [ReservationController::class, 'create'])->name('reservation.create');
    Route::get('/reservation/{reservation}', [ReservationController::class, 'show'])->name('reservation.show');
    Route::get('/reservation/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservation.edit');
    Route::put('/reservation/{reservation}', [ReservationController::class, 'update'])->name('reservation.update');
    Route::post('/reservation/book', [ReservationController::class, 'book'])->name('reservation.book');
    Route::delete('/reservation/{reservation}', [ReservationController::class, 'destroy'])->name('reservation.destroy');
});

//Route stripe
Route::post('/create-checkout-session', [PaymentController::class, 'createCheckoutSession'])->name('payment.create');
Route::get('/payment-success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment-cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');






// Inclure les routes d'authentification
require __DIR__ . '/auth.php';
