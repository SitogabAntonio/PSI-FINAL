<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
class ResetPasswordByAdminController extends Controller
{
    public function resetPassword($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->password = Hash::make('123');
            $user->save();
            Alert::success('Berhasil', 'Password berhasil di Reset!');

            return redirect('/akungereja')->with('success', 'Password berhasil di Reset!');
        }

        return redirect()->back()->with('error', 'User tidak ditemukan.');
    }
}
