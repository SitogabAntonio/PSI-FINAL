<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MengelolaAkunGerejaController extends Controller
{
    public function getViewAkunGereja()
    {
        $pagination = User::paginate(5)->withQueryString();
        return view('modules.admin.mengelolaakungereja.main', [
            "akungereja" => User::where('role_id', 2)
                ->latest()
                ->filter(request(['search']))
                ->paginate(10)
                ->withQueryString(),
        ], compact('pagination'));
    }

    public function createAkunGereja()
    {
        return view('modules.admin.mengelolaakungereja.create', []);
    }

    public function deleteAkunGereja($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect('/akungereja')->with('Akun Gereja berhasil dihapus!');
    }

    public function updateStatus(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'required',

        ]);
        $status_save = User::find($id);
        $status_save->status = $request->input('status');
        $status_save->save();
        Alert::success('Berhasil', 'Status Gereja berhasil di ubah!');
        return redirect('/akungereja')->with('Status Gereja berhasil di ubah!');

    }
}
