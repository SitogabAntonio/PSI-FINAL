<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WartaJemaat;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class WartaJemaatSuperAdminController extends Controller
{
    public function getViewWartaJemaatSuperAdmin()
    {
        $pagination = WartaJemaat::paginate(10)->withQueryString();
        $wartajemaatsuperadmin = WartaJemaat::latest()->filter(request(['search']))->paginate(10)->withQueryString();
        return view('modules.admin.wartaSuperAdmin.main', compact('wartajemaatsuperadmin', 'pagination'));
    }

    public function deleteWartaJemaatSuperAdmin($id)
    {
        $data = WartaJemaat::find($id);
        $data->delete();
        return redirect('/wartajemaat/superadmin')->with('success', 'Warta Jemaat telah dihapus!');
    }

    public function getUserList()
    {
        $users = User::select('id', 'name')
            ->when(request('search'), function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%');
            })
            ->latest()
            ->paginate(10);

        return view('modules.admin.wartaSuperAdmin.index', compact('users'));
    }


    public function getWartaJemaatByUser($userId)
    {
        $wartajemaatsuperadmin = WartaJemaat::where('user_id', $userId)->paginate(10)->withQueryString();
        $pagination = $wartajemaatsuperadmin;
        return view('modules.admin.wartaSuperAdmin.main', compact('wartajemaatsuperadmin', 'pagination'));
    }
}
