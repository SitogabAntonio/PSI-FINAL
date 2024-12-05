<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sejarah;
use App\Models\User;
use Illuminate\Http\Request;

class VisiMisiSuperAdminController extends Controller
{
    public function getViewVisiMisiSuperAdmin(Request $request)
    {
        $pagination = User::paginate(5)->withQueryString();
        $users = User::where('role_id', 2)->paginate(10);
        $search = $request->get('search');
        $akungereja = User::with(['visi', 'misi'])
            ->where('role_id', 2)
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('modules.admin.visimisiSuperAdmin.main', [
            'akungereja' => $akungereja,
            'pagination' => $pagination,
            'users' => $users
        ]);
    }
}
