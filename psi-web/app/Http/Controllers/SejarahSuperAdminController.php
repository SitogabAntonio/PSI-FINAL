<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sejarah;
use App\Models\User;
use Illuminate\Http\Request;

class SejarahSuperAdminController extends Controller
{
    public function getViewSejarahSuperAdmin(Request $request)
    {
        $pagination = User::paginate(5)->withQueryString();
        $users = User::where('role_id', 2)->paginate(10);
        $search = $request->get('search');
        $akungereja = User::with('sejarah')
            ->where('role_id', 2)
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('modules.admin.sejarahSuperAdmin.main', [
            'akungereja' => $akungereja,
            'pagination' => $pagination,
            'users' => $users
        ]);
    }

    public function deleteSejarahSuperAdmin($id)
    {
        $user = User::find($id);
        if (!$user || !$user->sejarah) {
            return redirect('/sejarah/superadmin')->with('error', 'Sejarah tidak ditemukan!');
        }
        $user->sejarah->delete();
        return redirect('/sejarah/superadmin')->with('success', 'Sejarah Gereja berhasil dihapus!');
    }
}
