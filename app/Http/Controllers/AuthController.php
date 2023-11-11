<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function create()
    {
        return Inertia::render('Auth/Login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $remember = $request->input('remember');
        if (Auth::attempt($credentials,$remember)){
            $request->session()->regenerate();
            return 'Berhasil login';
        }
        $request->session()->flash('messages','your email or password is invalid on flash');
        return back()->with('message','Your email or password is invalid');
    }

    function destroy()
    {
        Auth::logout();
        return redirect('/auth/login');
    }
}
