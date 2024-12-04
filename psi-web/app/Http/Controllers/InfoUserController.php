<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class InfoUserController extends Controller
{

    public function create()
    {
        return view('modules/admin/usermanage/user-profile');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            'domain' => [
                'min:5',
                'max:20',
                'regex:/^[a-zA-Z]+$/',
                Rule::unique('users')->ignore(Auth::user()->id),
                Rule::requiredIf(function () use ($request) {
                    return $request->has('domain') && $request->get('domain') !== Auth::user()->domain;
                }),
            ],
            'google_map' => ['max:10000'],
            'phone' => ['max:50'],
            'location' => ['max:70'],
            'about_me' => ['max:500'],
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        $imageData = null;
        $base64Image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageData = file_get_contents($image->getRealPath());
            $base64Image = base64_encode($imageData);
        }

        if ($request->get('email') != Auth::user()->email) {
            if (env('IS_DEMO') && Auth::user()->id == 1) {
                return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t change the email address.']);
            }
        } else {
            $attribute = $request->validate([
                'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            ]);
        }

        User::where('id', Auth::user()->id)
            ->update([
                'name' => $attributes['name'],
                'email' => $attribute['email'],
                'domain' => $attributes['domain'],
                'google_map' => $attributes['google_map'],
                'phone' => $attributes['phone'],
                'location' => $attributes['location'],
                'about_me' => $attributes["about_me"],
                'image' => $base64Image,
            ]);

        return redirect('/user-profile')->with('success', 'Profile updated successfully');
    }
}
