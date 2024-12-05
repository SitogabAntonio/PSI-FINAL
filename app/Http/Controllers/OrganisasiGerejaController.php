<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrganisasiGereja;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use DB;

class OrganisasiGerejaController extends Controller
{

    public function getViewListBPH()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userId = auth()->user()->id;
        $organisasigereja = OrganisasiGereja::where('user_id', $userId)->first();

        $bphList = DB::table('organisasi_gerejas')->get(); // Gunakan `collect()` jika data kosong


        return view('modules.admin.organisasigereja.list', [
            'listbph' => $organisasigereja
        ], compact('bphList'));
    }
    public function getViewOrganisasiGereja()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userId = auth()->user()->id;
        $organisasigereja = OrganisasiGereja::where('user_id', $userId)->first();


        return view('modules.admin.organisasigereja.main', [
            'organisasigereja' => $organisasigereja
        ]);
    }

    public function saveCreateOrganisasiGereja(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus masuk untuk menambahkan Organisasi.']);
        }

        // Validasi data input
        $validatedData = $request->validate([
            'jabatan' => 'required|string|max:255', // Tambahkan 'required' jika wajib
            'nama' => 'required|string|max:255',    // Tambahkan 'required' jika wajib
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:15120',
        ]);

        // Simpan data ke model OrganisasiGereja
        $organisasigereja_save = new OrganisasiGereja();
        $organisasigereja_save->jabatan = $request->jabatan;
        $organisasigereja_save->nama = $request->nama;

        // Jika ada file yang diunggah, simpan sebagai Base64
        if ($request->hasFile('foto')) {
            try {
                $imageData = file_get_contents($request->file('foto')->getRealPath());
                $organisasigereja_save->foto = base64_encode($imageData);
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'Gagal memproses file foto.']);
            }
        }

        // Simpan user_id dari pengguna yang sedang login
        $organisasigereja_save->user_id = auth()->user()->id;

        // Simpan ke database
        $organisasigereja_save->save();

        // Berikan notifikasi keberhasilan
        Alert::success('Berhasil', 'Organisasi Gereja telah ditambahkan!');
        return redirect('/organisasigereja')->with('success', 'Data pengurus gereja telah diperbaharui.');
    }

    public function getEditOrganisasiGereja($id)
    {
        $bph = OrganisasiGereja::find($id); // Retrieve a single record by ID

        if (!$bph) {
            return redirect()->route('organisasigereja.list')->withErrors(['error' => 'Data tidak ditemukan']);
        }

        return view('modules.admin.organisasigereja.edit', compact('bph')); // Pass the single model to the view
    }




    public function saveUpdateOrganisasiGereja(Request $request, $id)
    {
        $validatedData = $request->validate([
            'jabatan' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png|max:15120',
        ]);

        $organisasigereja = OrganisasiGereja::find($id);

        if (!$organisasigereja) {
            return redirect()->route('/organisasigereja')->withErrors(['error' => 'Data tidak ditemukan']);
        }

        $organisasigereja->jabatan = $request->jabatan;
        $organisasigereja->nama = $request->nama;

        // Process and store the uploaded photo (if any)
        if ($request->hasFile('foto')) {
            try {
                $imageData = file_get_contents($request->file('foto')->getRealPath());
                $organisasigereja->foto = base64_encode($imageData);
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'Gagal memproses file foto.']);
            }
        }

        $organisasigereja->save();

        Alert::success('Berhasil', 'Data organisasi gereja telah diperbarui!');
        return redirect('/organisasigereja');
    }

    public function deleteOrganisasiGereja($id)
    {
        $organisasigereja = OrganisasiGereja::find($id);

        if (!$organisasigereja) {
            return redirect()->route('organisasigereja.list')->withErrors(['error' => 'Data tidak ditemukan']);
        }

        $organisasigereja->delete();

        Alert::success('Berhasil', 'BPH telah dihapus!');
        return redirect('/organisasigereja');
    }


    // public function hapusFoto($user_id, $column)
    // {
    //     $organisasigereja = OrganisasiGereja::where('user_id', $user_id)->first();

    //     if (!$organisasigereja) {
    //         return redirect()->back()->withErrors(['error' => 'Data tidak ditemukan untuk user ini']);
    //     }
    //     if (in_array($column, ['image_pendeta', 'image_guru_huria', 'image_biblevroh', 'image_bendahara_gereja', 'image_sekretaris_gereja'])) {
    //         $organisasigereja->$column = null;
    //         $organisasigereja->save();
    //         return redirect('/organisasigereja')->with('success', 'Foto berhasil dihapus');
    //     } else {
    //         return redirect()->back()->withErrors(['error' => 'Kolom gambar tidak valid']);
    //     }
    // }
}
