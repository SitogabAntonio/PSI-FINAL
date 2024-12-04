<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SukaDukaCita;

class SukaDukaCitaSuperAdminController extends Controller
{
    public function getViewSukaDukaCitaSuperAdmin()
    {
        $sukadukacitasuperadmin = SukaDukaCita::latest()->filter(request(['search']))->paginate(10)->withQueryString();
        return view('modules.admin.sukadukacitaSuperAdmin.main', compact('sukadukacitasuperadmin'));
    }
    public function deleteSukaDukaCitaSuperAdmin($id)
    {
        $data = SukaDukaCita::find($id);
        $data->delete();
        return redirect('/sukadukacita/superadmin')->with('Berita Suka Duka Cita telah dihapus!');

    }
}
