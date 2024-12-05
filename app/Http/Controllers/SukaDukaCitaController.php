<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SukaDukaCita;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SukaDukaCitaController extends Controller
{
    public function getViewSukaDukaCita()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userId = auth()->user()->id;
        return view('modules.admin.sukadukacita.main', [
            "sukadukacita" => SukaDukaCita::where('user_id', $userId)
                ->latest()
                ->filter(request(['search']))
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    public function createSukaDukaCita()
    {
        return view('modules.admin.sukadukacita.create', [
            'active' => 'createsukadukacita',
            'title' => 'Tambah Berita Suka Duka Cita',
            'catproduct' => SukaDukaCita::all(),
        ]);
    }
    public function saveCreateSukaDukaCita(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus masuk untuk menambahkan berita Suka / Duka.']);
        }

        $validatedData = $request->validate([
            'judul' => 'required',
            'description' => 'required',
            'detail' => 'required',
            'tanggal' => 'required',
            'category' => 'required',
        ]);

        $sukadukacita_save = new SukaDukaCita();
        $sukadukacita_save->judul = $request->judul;
        $sukadukacita_save->description = $request->description;
        $sukadukacita_save->tanggal = $request->tanggal;
        $sukadukacita_save->detail = $request->detail;
        $sukadukacita_save->category = $request->category;

        $sukadukacita_save->user_id = auth()->user()->id;

        $sukadukacita_save->save();
        Alert::success('Berhasil', 'Berita Suka Duka Cita telah ditambahkan!');
        return redirect('/sukadukacita')->with('Berita Suka Duka Cita telah ditambahkan!');

    }



    public function saveUpdateSukaDukaCita(Request $request, $id)
    {
        $validatedData = $request->validate([
            'judul' => 'required',
            'description' => 'required',
            'detail' => 'required',
            'tanggal' => 'required',
            'category' => 'required',

        ]);
        $sukadukacita_save_update = SukaDukaCita::find($id);
        $sukadukacita_save_update->judul = $request->input('judul');
        $sukadukacita_save_update->description = $request->input('description');
        $sukadukacita_save_update->detail = $request->input('detail');
        $sukadukacita_save_update->tanggal = $request->input('tanggal');
        $sukadukacita_save_update->category = $request->input('category');


        $sukadukacita_save_update->save();
        Alert::success('Berhasil', 'Berita Suka / Duka cita telah diubah!');
        return redirect('/sukadukacita')->with('Berita Suka Duka Cita telah diubah!');
    }


    public function deleteSukaDukaCita($id)
    {
        $data = SukaDukaCita::find($id);
        $data->delete();
        return redirect('/sukadukacita')->with('Berita Suka Duka Cita telah dihapus!');
    }
}
