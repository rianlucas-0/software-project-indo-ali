<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('signup');
});

Route::get('/privacy-policy', function () {
    return view('privacy');
});

Route::get('/data-deletion', function () {
    return view('data_deletion');
});

Route::get('/auth/{provider}/redirect', function (string $provider) {
    return Socialite::driver($provider)->redirect();
});

Route::get('/auth/{provider}/callback', function (string $provider) {
    $providerUser = Socialite::driver($provider)->user();

    $user = User::updateOrCreate([
        'email' => $providerUser->email,
    ], [
        'provider_id' => $providerUser->id,
        'name' => $providerUser->name,
        'provider_avatar' => $providerUser->avatar,
        'provider_name' => $provider,
    ]);

    Auth::login($user);

    return redirect('/logged');
});

Route::get('/logged', function () {
    var_dump(auth()->user());
});