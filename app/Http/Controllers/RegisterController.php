<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('session.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'domain' => ['required', 'min:5', 'max:20', 'regex:/^[a-zA-Z]+$/', 'unique:users'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
        ]);
        $attributes['password'] = bcrypt($attributes['password']);



        session()->flash('success', 'Akun telah dibuat.');
        $user = User::create($attributes);
        return redirect('/akungereja');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required'],
            'new_password' => ['required', 'min:8', 'max:20'],
        ]);
        $user = Auth::user();
        if (!Hash::check($request->input('old_password'), $user->password)) {
            return back()->withErrors(['old_password' => 'Kata sandi lama tidak sesuai']);
        }
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return redirect('/user-profile')->with('success', 'Kata sandi berhasil diubah');
    }
}
