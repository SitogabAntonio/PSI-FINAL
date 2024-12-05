<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keuangan;
use App\Models\User;
use PDF;
use Illuminate\Support\Facades\Auth;

class KeuanganSuperAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getviewGereja()
    {
        if (Auth::user() && Auth::user()->role_id === 1) {
            // $users = User::paginate(10);
            $users = User::latest()->filter(request(['search']))->paginate(10)->withQueryString();
            return view('modules.admin.keuanganSuperAdmin.index', compact('users'));
        }

        return redirect()->route('home')->with('error', 'You are not authorized to access this page.');
    }

    public function index($userId)
    {
        $pemasukan = Keuangan::where('kategori', 'pemasukan')
            ->where('user_id', $userId)
            ->paginate(10);

        $pengeluaran = Keuangan::where('kategori', 'pengeluaran')
            ->where('user_id', $userId)
            ->paginate(10);

        return view('modules.admin.keuanganSuperAdmin.main', compact('pemasukan', 'pengeluaran'));
    }
}
