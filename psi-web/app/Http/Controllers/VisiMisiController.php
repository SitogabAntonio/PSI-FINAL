<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Misi;
use App\Models\Visi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class VisiMisiController extends Controller
{
    public function getViewMisi()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $userId = auth()->user()->id;

        $paginationMisi = Misi::where('user_id', $userId)
            ->latest()
            ->filter(request()->only(['search']))
            ->paginate(3, ['*'], 'page_misi')
            ->withQueryString();

        $paginationVisi = Visi::where('user_id', $userId)
            ->latest()
            ->filter(request()->only(['searchvisi']))
            ->paginate(3, ['*'], 'page_visi')
            ->withQueryString();

        return view('modules.admin.visimisi.main', [
            'misi' => $paginationMisi,
            'visi' => $paginationVisi,
        ]);
    }
    public function createMisi()
    {
        return view('modules.admin.visimisi.createmisi', [
            'active' => 'createmisi',
            'title' => 'Tambah Misi',
            'catproduct' => Misi::all(),
        ]);
    }
    public function saveCreateMisi(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus masuk untuk menambahkan misi.']);
        }

        $validatedData = $request->validate([
            'title_misi' => 'required',
        ]);
        $misi_save = new Misi();
        $misi_save->title_misi = $request->title_misi;

        $misi_save->user_id = auth()->user()->id;
        $misi_save->save();
        Alert::success('Berhasil', 'Misi telah ditambahkan!');
        return redirect('/visi-misi')->with('success', 'Misi telah ditambahkan!');
    }


    public function updateMisi(Request $request, $id)
    {
        $misi = Misi::findorfail($id);
        return view('modules.admin.visimisi.update', compact('misi'), [
            'title' => 'Ubah Ayat Harian',
            'active' => 'mengelolamisi',
        ]);
    }

    public function saveUpdateMisi(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title_misi' => 'required',

        ]);
        $misi_save_update = Misi::find($id);
        $misi_save_update->title_misi = $request->input('title_misi');

        $misi_save_update->save();
        Alert::success('Berhasil', 'Misi telah diubah!');
        return redirect('/visi-misi')->with('success', 'Misi telah diubah!');
    }


    public function deleteMisi($id)
    {
        $data = Misi::find($id);
        $data->delete();
        return redirect('/visi-misi')->with('success', 'Misi telah dihapus!');
    }

    public function getViewVisi()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userId = auth()->user()->id;
        return view('modules.admin.visimisi.main', [
            "visi" => Visi::where('user_id', $userId)
                ->latest()
                ->filter(request(['search']))
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    public function createVisi()
    {
        return view('modules.admin.visimisi.createvisi', [
            'active' => 'createvisi',
            'title' => 'Tambah Visi',
            'catproduct' => Visi::all(),
        ]);
    }
    public function saveCreateVisi(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus masuk untuk menambahkan Visi.']);
        }

        $validatedData = $request->validate([
            'title_visi' => 'required',
        ]);
        $visi_save = new Visi();
        $visi_save->title_visi = $request->title_visi;

        $visi_save->user_id = auth()->user()->id;
        $visi_save->save();
        Alert::success('Berhasil', 'Visi telah ditambahkan!');
        return redirect('/visi-misi')->with('success', 'Visi telah ditambahkan!');
    }


    public function updateVisi(Request $request, $id)
    {
        $visi = Visi::findorfail($id);
        return view('modules.admin.visimisi.update', compact('misi'), [
            'title' => 'Ubah Ayat Harian',
            'active' => 'mengelolamisi',
        ]);
    }

    public function saveUpdateVisi(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title_visi' => 'required',

        ]);
        $visi_save_update = Visi::find($id);
        $visi_save_update->title_visi = $request->input('title_visi');

        $visi_save_update->save();
        Alert::success('Berhasil', 'Visi telah diubah!');
        return redirect('/visi-misi')->with('success', 'Visi telah diubah!');
    }


    public function deleteVisi($id)
    {
        $data = Visi::find($id);
        $data->delete();
        return redirect('/visi-misi')->with('success', 'Visi telah dihapus!');
    }
}
