<?php

namespace App\Http\Controllers;

use App\Models\AnggotaGereja;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;  // This will resolve the 'Excel' class
use App\Imports\AnggotaGerejaImport;   // This will resolve the 'AnggotaGerejaImport' class


class AnggotaController extends Controller
{
    // Menampilkan halaman daftar anggota
    public function anggota(Request $request)
    {
        // Ambil input pencarian
        $search = $request->get('search');

        // Jika ada query pencarian, lakukan filter berdasarkan nama, no_kk, atau keluarga
        $anggotaGereja = AnggotaGereja::query()
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('no_kk', 'like', "%{$search}%")
                    ->orWhere('keluarga', 'like', "%{$search}%");
            })
            ->paginate(5);
        // Menambahkan pagination, 10 data per halaman

        return view('modules.admin.anggotagereja.list_anggota', compact('anggotaGereja'));
    }




    // Menampilkan halaman form untuk menambah anggota gereja
    public function viewaddanggota()
    {
        return view('modules.admin.anggotagereja.add_anggota');
    }

    // Menyimpan data anggota gereja yang baru
    public function store(Request $request)
    {
        // Validasi inputan
        $validatedData = $request->validate([
            'keluarga.*' => 'required|string|max:255',
            'no_kk.*' => 'required|string|max:20',
            'nama.*' => 'required|string|max:255',
        ]);

        // Menyimpan data anggota gereja ke dalam database
        foreach ($request->keluarga as $index => $keluarga) {
            AnggotaGereja::create([
                'keluarga' => $keluarga,
                'no_kk' => $request->no_kk[$index],
                'nama' => $request->nama[$index],
                'user_id' => auth()->id(), // Pastikan user sudah login
            ]);
        }

        // Mengarahkan ke halaman daftar anggota dengan pesan sukses
        return redirect()->back()->with('success', 'Anggota Gereja berhasil ditambahkan!');
    }

    // Controller: AnggotaController.php
    public function update(Request $request, $id)
    {
        $anggota = AnggotaGereja::findOrFail($id);

        // Validasi input jika diperlukan
        $validated = $request->validate([
            'keluarga' => 'required|string|max:255',
            'no_kk' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
        ]);

        // Update data anggota
        $anggota->keluarga = $request->keluarga;
        $anggota->no_kk = $request->no_kk;
        $anggota->nama = $request->nama;
        $anggota->save();

        // Redirect kembali ke halaman anggota dengan pesan sukses
        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil diperbarui!');
    }


    // Controller: AnggotaController.php
    public function delete($id)
    {
        $anggota = AnggotaGereja::findOrFail($id); // Menemukan anggota berdasarkan ID
        $anggota->delete(); // Menghapus data anggota
        return redirect()->back()->with('success', 'Anggota berhasil dihapus!');
    }

    // Import Excel
    public function import(Request $request)
    {
        // Validasi file yang diupload
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,ods|max:2048',
        ]);

        // Mengimpor data dari file Excel
        try {
            $file = $request->file('file');
            Excel::import(new AnggotaGerejaImport, $file);

            return redirect()->back()->with('success', 'Data anggota berhasil diupload!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupload data. Coba lagi.');
        }
    }


}
