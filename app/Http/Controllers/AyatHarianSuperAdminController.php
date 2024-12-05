<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AyatHarian;
use RealRashid\SweetAlert\Facades\Alert;

class AyatHarianSuperAdminController extends Controller
{
    public function getViewAyatHarianSuperAdmin()
    {
        $pagination = AyatHarian::paginate(10)->withQueryString();
        $ayathariansuperadmin = AyatHarian::latest()->filter(request(['search']))->paginate(10)->withQueryString();
        return view('modules.admin.ayatharianSuperAdmin.main', compact('ayathariansuperadmin','pagination'));
    }
    public function deleteAyatHarianSuperAdmin($id)
    {
        $data = AyatHarian::find($id);
        $data->delete();
        return redirect('/ayatharian/superadmin')->with('success', 'Ayat Harian telah dihapus!');

    }
}
