<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt($attributes)) {
            $user = Auth::user();
            if ($user->status === 'BLOCKED') {
                Auth::logout();
                return back()->withErrors(['email' => 'Akun Anda diblokir.']);
            }
            session()->regenerate();
            return redirect('dashboard')->with(['success' => 'You are logged in.']);
        } else {
            return back()->withErrors(['email' => 'Email or password invalid.']);
        }
    }


    public function destroy()
    {

        Auth::logout();

        return redirect(to: '/login')->with(['success' => 'You\'ve been logged out.']);
    }
}
