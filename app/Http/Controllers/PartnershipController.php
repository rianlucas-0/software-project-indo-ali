<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PartnershipRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnershipController extends Controller
{
    public function create()
    {
        if (Auth::check() && Auth::user()->user_type === 'admin') {
            return redirect()->route('dashboard')->with('info', 'Você já é um parceiro!');
        }

        return view('become-partner');
    }

    public function store(Request $request)
    {
        $request->validate([
            'motivation' => 'required|string|min:50|max:1000',
            'experience' => 'nullable|string|max:500',
        ]);

        $existingRequest = PartnershipRequest::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        if ($existingRequest) {
            return redirect()->route('become-partner')
                ->with('error', 'Você já tem uma solicitação pendente!');
        }

        PartnershipRequest::create([
            'user_id' => Auth::id(),
            'motivation' => $request->motivation,
            'experience' => $request->experience,
            'status' => 'pending'
        ]);

        return redirect()->route('become-partner')
            ->with('success', 'Solicitação enviada com sucesso! Entraremos em contato em breve.');
    }
}