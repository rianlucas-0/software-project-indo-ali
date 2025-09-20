<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function cookies()
    {
        return view('policies.cookies');
    }

    public function terms()
    {
        return view('policies.terms');
    }

    public function privacy()
    {
        return view('policies.privacy');
    }

    public function consent()
    {
        return view('policies.consent');
    }
}
