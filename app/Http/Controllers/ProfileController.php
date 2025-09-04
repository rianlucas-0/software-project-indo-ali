<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|string|email|max:255|unique:users,email,'.$request->user()->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = $request->user();

        // Se foi enviado um novo avatar
        if ($request->hasFile('avatar')) {
            // Remove avatar antigo se não for link externo
            if ($user->avatar && !filter_var($user->avatar, FILTER_VALIDATE_URL)) {
                Storage::delete('public/avatars/' . basename($user->avatar));
            }

            // Armazena novo avatar e reseta dados de provedores sociais
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = Storage::url($avatarPath);
            $user->provider_avatar = null;
            $user->provider_name = null;
        }

        // Atualiza nome e email
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Só valida senha se o usuário tiver uma definida
        if (!is_null($user->password)) {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ]);
        }

        Auth::logout();

        $user->delete();

        // Invalida e regenera sessão
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Remove o avatar do usuário
     */
    public function removeAvatar(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Remove avatar físico se existir
        if ($user->avatar) {
            $avatarPath = public_path('img/avatars/' . $user->avatar);
            if (file_exists($avatarPath)) {
                unlink($avatarPath);
            }
            $user->avatar = null;
        }

        // Remove avatar de provedores sociais
        if ($user->provider_avatar) {
            $user->provider_avatar = null;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('status', 'avatar-removed');
    }

    /**
     * Atualiza o avatar do usuário
     */
    public function updateAvatar(Request $request): RedirectResponse
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = $request->user();

        // Remove avatar anterior se existir
        if ($user->avatar) {
            $oldAvatarPath = public_path('img/avatars/' . $user->avatar);
            if (file_exists($oldAvatarPath)) {
                unlink($oldAvatarPath);
            }
        }

        // Cria nome único para novo avatar
        $avatarName = 'avatar_' . $user->id . '_' . time() . '.' . $request->avatar->extension();

        // Move avatar para pasta pública
        $request->avatar->move(public_path('img/avatars'), $avatarName);

        // Salva apenas o nome do arquivo
        $user->avatar = $avatarName;

        // Limpa dados de provedores sociais se existirem
        if ($user->provider_avatar) {
            $user->provider_avatar = null;
            $user->provider_name = null;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('status', 'avatar-updated');
    }
}