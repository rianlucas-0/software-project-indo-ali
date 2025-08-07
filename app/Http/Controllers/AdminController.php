<?php

namespace App\Http\Controllers;

use App\Models\Local;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addlocal() {
        return view('admin.add_local');
    }

    public function createlocal(Request $request) {
        $local = new Local();
        $local->title = $request->title;
        $local->description = $request->description;
        $image = $request->image;
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $local->image=$imagename;
        $local->cep = $request->cep;
        $local->address = $request->address;
        $local->neighborhood = $request->neighborhood;
        $local->city = $request->city;
        $local->state = $request->state;
        $local->phone = $request->phone;
        $local->contact_email = $request->contact_email;
        $local->user_name = Auth::User()->name;
        $local->user_id = Auth::User()->id;
        $local->save();
        if($local->save()) {
            $request->image->move('img', $imagename);
            return redirect()->route('admin.addlocal')->with('status', 'Adicionado com sucesso!');;
        }
    }
}
