<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sejarah;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SejarahController extends Controller
{
    public function getViewSejarah()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userId = auth()->user()->id;
        $sejarah = Sejarah::where('user_id', $userId)->first();

        return view('modules.admin.sejarah.main', [
            'sejarah' => $sejarah
        ]);
    }

    public function saveCreateSejarah(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus masuk untuk menambahkan Sejarah Gereja.']);
        }

        $validatedData = $request->validate([
            'sejarah' => 'nullable|string',
        ]);

        $sejarah_save = new Sejarah();
        $sejarah_save->sejarah = $validatedData['sejarah'];
        $sejarah_save->user_id = auth()->user()->id;
        $sejarah_save->save();

        Alert::success('Berhasil', 'Sejarah Gereja telah ditambahkan!');
        return redirect('/sejarah')->with('success', 'Data Sejarah Gereja telah ditambahkan.');
    }

    public function saveUpdateSejarah(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus masuk untuk memperbarui Sejarah Gereja.']);
        }

        $validatedData = $request->validate([
            'sejarah' => 'nullable|string',
        ]);

        $sejarah = Sejarah::find($id);
        if (!$sejarah || $sejarah->user_id !== auth()->user()->id) {
            return redirect()->back()->withErrors(['error' => 'Data tidak ditemukan atau Anda tidak memiliki akses.']);
        }

        $sejarah->sejarah = $validatedData['sejarah'];
        $sejarah->save();

        Alert::success('Berhasil', 'Sejarah Gereja telah diperbarui!');
        return redirect('/sejarah')->with('success', 'Data Sejarah Gereja telah diperbarui.');
    }
}
