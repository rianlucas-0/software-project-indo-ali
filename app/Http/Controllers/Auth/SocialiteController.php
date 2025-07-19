<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SocialiteController extends Controller
{
    public function redirect(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider)
    {
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

        return redirect('/dashboard');
    }
}
