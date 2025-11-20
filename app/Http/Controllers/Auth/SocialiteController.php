<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    public function redirect(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider)
    {
        try {
            $providerUser = Socialite::driver($provider)->user();

            $user = User::where('email', $providerUser->getEmail())->first();
            
            if ($user) {
                Auth::login($user);
                return redirect('/');
            } else {
                session()->put('social_user', [
                    'provider' => $provider,
                    'provider_id' => $providerUser->getId(),
                    'name' => $providerUser->getName(),
                    'email' => $providerUser->getEmail(),
                    'provider_avatar' => $providerUser->getAvatar(),
                ]);
                
                return redirect()->route('social.register');
            }
            
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['error' => 'Falha na autenticação social']);
        }
    }

    public function showRegistrationForm()
    {
        if (!session()->has('social_user')) {
            return redirect()->route('login');
        }
        
        return view('auth.social-register');
    }

    public function register(Request $request)
    {
        if (!session()->has('social_user')) {
            return redirect()->route('login');
        }
        
        $request->validate([
            'terms_accepted' => 'required|accepted',
        ], [
            'terms_accepted.required' => 'Você deve aceitar os termos para continuar.',
            'terms_accepted.accepted' => 'Você deve aceitar os termos para continuar.',
        ]);
        
        $socialUser = session('social_user');
        
        $user = User::create([
            'name' => $socialUser['name'],
            'email' => $socialUser['email'],
            'password' => null,
            'provider_id' => $socialUser['provider_id'],
            'provider_avatar' => $socialUser['provider_avatar'],
            'provider_name' => $socialUser['provider'],
            'terms_accepted_at' => now(),
        ]);
        
        session()->forget('social_user');
        
        Auth::login($user);
        
        return redirect('/')->with('status', 'Cadastro realizado com sucesso!');
    }
}