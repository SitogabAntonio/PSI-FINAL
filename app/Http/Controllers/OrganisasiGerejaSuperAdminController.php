<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrganisasiGereja;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OrganisasiGerejaSuperAdminController extends Controller
{
    public function getViewOrganisasiGerejaSuperAdmin()
    {
        $pagination = OrganisasiGereja::paginate(10)->withQueryString();
        $organisasigerejasuperadmin = OrganisasiGereja::latest()->filter(request(['search']))->paginate(10)->withQueryString();
        return view('modules.admin.organisasigerejaSuperAdmin.main', compact('organisasigerejasuperadmin','pagination'));
    }
    public function deleteOrganisasiGerejaSuperAdmin($id)
    {
        $data = OrganisasiGereja::find($id);
        $data->delete();
        return redirect('/organisasigereja/superadmin')->with('Organisasi Gereja berhasil di ubah!');

    }
}
