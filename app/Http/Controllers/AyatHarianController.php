<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AyatHarian;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AyatHarianController extends Controller
{
    public function getViewAyatHarian()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userId = auth()->user()->id;
        return view('modules.admin.ayatharian.main', [
            "ayatharian" => AyatHarian::where('user_id', $userId)
                ->latest()
                ->filter(request(['search']))
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    public function createAyatHarian()
    {
        return view('modules.admin.ayatharian.create', [
            'active' => 'createayatharian',
            'title' => 'Tambah Ayat Harian',
            'catproduct' => AyatHarian::all(),
        ]);
    }
    public function saveCreateAyatHarian(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus masuk untuk menambahkan ayat harian.']);
        }

        $validatedData = $request->validate([
            'tema' => 'required',
            'ayat' => 'required',
            'isi_ayat' => 'required',
            'detail' => 'required',
            'tanggal' => 'required|date',
        ]);

        $ayatharian_save = new AyatHarian();
        $ayatharian_save->tema = $request->tema;
        $ayatharian_save->ayat = $request->ayat;
        $ayatharian_save->isi_ayat = $request->isi_ayat;
        $ayatharian_save->detail = $request->detail;
        $ayatharian_save->tanggal = $request->tanggal;
        $ayatharian_save->user_id = auth()->user()->id;
        $ayatharian_save->save();
        Alert::success('Berhasil', 'Ayat Harian telah ditambahkan!');
        return redirect('/ayatharian')->with('success', 'Ayat Harian telah ditambahkan!');
    }


    public function updateAyatHarian(Request $request, $id)
    {
        $ayatharian = AyatHarian::findorfail($id);
        return view('modules.admin.ayatharian.update', compact('ayatharian'), [
            'title' => 'Ubah Ayat Harian',
            'active' => 'mengelolaayatharian',
        ]);
    }

    public function saveUpdateAyatHarian(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tema' => 'required',
            'ayat' => 'required',
            'isi_ayat' => 'required',
            'detail' => 'required',
            'tanggal' => 'required|date',
        ]);
        $ayatharian_save_update = AyatHarian::find($id);
        $ayatharian_save_update->tema = $request->input('tema');
        $ayatharian_save_update->ayat = $request->input('ayat');
        $ayatharian_save_update->isi_ayat = $request->input('isi_ayat');
        $ayatharian_save_update->detail = $request->input('detail');
        $ayatharian_save_update->tanggal = $request->input('tanggal');
        $ayatharian_save_update->save();
        Alert::success('Berhasil', 'Ayat Harian telah diubah!');
        return redirect('/ayatharian')->with('success', 'Ayat Harian telah diubah!');
    }


    public function deleteAyatHarian($id)
    {
        $data = AyatHarian::find($id);
        $data->delete();
        return redirect('/ayatharian')->with('success', 'Ayat Harian telah dihapus!');
    }
}
