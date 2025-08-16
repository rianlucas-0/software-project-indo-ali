<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback']);

require __DIR__.'/auth.php';
