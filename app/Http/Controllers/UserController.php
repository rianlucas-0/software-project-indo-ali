<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Local;

class UserController extends Controller
{
    public function showDataInHome() {
        $local = Local::all();
        return view('home', compact('local'));
    }

    public function index(Request $request){
        if($request->user()->user_type == 'admin') {
            return view('admin.dashboard');
        }
        else {
            return redirect()->route('dashboard');
        }
    }

    public function home(Request $request){
        if($request->user()->user_type == 'user') {
            return view('dashboard');
        }
        else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function showFullLocal($id) {
        $local = Local::findOrFail($id);
        return view('localfull', compact('local'));
    }
}
