<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FavoriteController;

Route::get('/', [UserController::class, 'showDataInHome'])->name('home');
Route::get('localfull/{id}', [UserController::class, 'showFullLocal'])->name('localfull');
Route::get('/dashboard', [UserController::class, 'home'])->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function(){
    Route::get('/dashboard',[UserController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard/addlocal',[AdminController::class, 'addlocal'])->name('admin.addlocal');
    Route::post('/dashboard/addlocal',[AdminController::class, 'createlocal'])->name('admin.createlocal');
    Route::get('/dashboard/all_local',[AdminController::class, 'all_local'])->name('admin.all_local');
    Route::get('/dashboard/all_local/{id}',[AdminController::class, 'updatelocal'])->name('admin.updatelocal');
    Route::put('/dashboard/all_local/{id}',[AdminController::class, 'localupdate'])->name('admin.localupdate');
    Route::delete('/dashboard/deletelocal/{id}',[AdminController::class, 'destroy'])->name('admin.deletelocal');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/avatar/remove', [ProfileController::class, 'removeAvatar'])->name('profile.avatar.remove');
    Route::patch('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');

    Route::get('/history', [UserController::class, 'showHistory'])->name('history');
    Route::post('/history/clear', [UserController::class, 'clearHistory'])->name('history.clear');
    Route::delete('/history/remove/{id}', [UserController::class, 'removeHistoryItem'])->name('history.remove');

    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/toggle/{locationId}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favorites/check/{locationId}', [FavoriteController::class, 'check'])->name('favorites.check');
    Route::delete('/favorites/remove/{favorite}', [FavoriteController::class, 'remove'])->name('favorites.remove');
});

Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback']);

require __DIR__.'/auth.php';
