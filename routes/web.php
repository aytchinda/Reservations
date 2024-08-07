<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalityController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepresentationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;





Route::get('/',[HomeController::class,'homepage']);
// Page Home pour les utilisateurs authentifiés
Route::get('/home', [HomeController::class, 'home'])->middleware(['auth'])->name('home');

//Route Artist
Route::get('/artist', [ArtistController::class, 'index'])->name('artist.index');
Route::get('/artist/{id}', [ArtistController::class, 'show'])  ->where('id', '[0-9]+')->name('artist.show');
Route::get('/artist/edit/{id}', [ArtistController::class, 'edit'])  ->where('id', '[0-9]+')->name('artist.edit');
Route::put('/artist/{id}', [ArtistController::class, 'update'])  ->where('id', '[0-9]+')->name('artist.update');
Route::get('/artist/create', [ArtistController::class, 'create'])->name('artist.create');
Route::post('/artist', [ArtistController::class, 'store'])->name('artist.store');
Route::delete('/artist/{id}', [ArtistController::class, 'destroy']) ->where('id', '[0-9]+')->name('artist.delete');


Route::get('/type', [TypeController::class, 'index'])->name('type.index');
Route::get('/type/{id}', [TypeController::class, 'show'])
		->where('id', '[0-9]+')->name('type.show');

Route::get('/locality', [LocalityController::class, 'index']) ->name('locality_index');
Route::get('/locality/{id}', [LocalityController::class, 'show'])
		->where('id', '[0-9]+')->name('locality_show');

Route::get('/role', [RoleController::class, 'index'])->name('role_index');
Route::get('/role/{id}', [RoleController::class, 'show'])
		->where('id', '[0-9]+')->name('role_show');

Route::get('/locality', [LocalityController::class, 'index'])->name('locality_index');
Route::get('/locality/{id}', [LocalityController::class, 'show'])
->where('id', '[0-9]+')->name('locality_show');

//Route Location
Route::get('location', [LocationController::class, 'index'])->name('location_index');
Route::get('location/{id}', [LocationController::class, 'show'])
->where('id', '[0-9]+')->name('location_show');

//Routes Show
Route::get('/show', [ShowController::class, 'index'])->name('show.index');
Route::get('/show/{id}', [ShowController::class, 'show'])
->where('id', '[0-9]+')->name('show.show');

//Routes Representation
Route::get('/representation', [RepresentationController::class, 'index'])
->name('representation_index');
Route::get('/representation/{id}', [RepresentationController::class, 'show'])
->where('id', '[0-9]+')->name('representation_show');




// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
