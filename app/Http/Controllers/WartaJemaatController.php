<?php

namespace App\Http\Controllers;

use App\Models\WartaJemaat;
use App\Models\DetailWartaJemaat;
use App\Models\Keuangan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class WartaJemaatController extends Controller
{
    public function getViewWartaJemaat()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userId = auth()->user()->id;

        $warta = WartaJemaat::where('user_id', $userId)
            ->latest()
            ->filter(request(['search']))
            ->with('detailWartas')
            ->paginate(10)
            ->withQueryString();

        return view('modules.admin.warta.main', [
            'warta' => $warta,
        ]);
    }


    public function createWartaJemaat()
    {
        return view('modules.admin.warta.create', [
            'active' => 'createwartajemaat',
            'title' => 'Tambah Warta Jemaat',
            'warta' => WartaJemaat::all(),
        ]);
    }

    public function saveCreateWartaJemaat(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required',
            'tanggal' => 'nullable|date',
            'penkotbah' => 'required',
            'judul_renungan' => 'required',
            'isi_renungan' => 'required',
            'deskripsi_pengumuman' => 'required',
            'header.*' => 'required|string',
            'isi.*' => 'required|string',
        ]);

        if (empty($validatedData['header']) || empty($validatedData['isi'])) {
            return redirect()->back()->withErrors(['detail_required' => 'Anda harus mengisi detail warta.']);
        }

        $wartaJemaat = WartaJemaat::create([
            'judul' => $validatedData['judul'],
            'tanggal' => $validatedData['tanggal'],
            'penkotbah' => $validatedData['penkotbah'],
            'judul_renungan' => $validatedData['judul_renungan'],
            'isi_renungan' => $validatedData['isi_renungan'],
            'deskripsi_pengumuman' => $validatedData['deskripsi_pengumuman'],
            'user_id' => auth()->user()->id,
        ]);

        foreach ($validatedData['header'] as $index => $header) {
            DetailWartaJemaat::create([
                'warta_jemaat_id' => $wartaJemaat->id,
                'header' => $header,
                'isi' => $validatedData['isi'][$index],
            ]);
        }

        Alert::success('Berhasil', 'Warta Jemaat telah ditambahkan!');
        return redirect('/wartajemaat')->with('success', 'Warta Jemaat telah ditambahkan!');
    }


    public function updateWartaJemaat($id)
    {
        $wartaJemaat = WartaJemaat::findOrFail($id);
        return view('modules.admin.warta.update', [
            'wartajemaat' => $wartaJemaat,
            'title' => 'Ubah Warta Jemaat',
            'active' => 'mengelolaWartaJemaat',
        ]);
    }

    public function saveUpdateWartaJemaat(Request $request, $id)
    {
        $validatedData = $request->validate([
            'judul' => 'required',
            'tanggal' => 'nullable|date',
            'judul_renungan' => 'required',
            'isi_renungan' => 'required',
            'penkotbah' => 'required',
            'deskripsi_pengumuman' => 'required',
            'header.*' => 'required|string',
            'isi.*' => 'required|string',
        ]);

        if (empty($validatedData['header']) || empty($validatedData['isi'])) {
            return redirect()->back()->withErrors(['detail_required' => 'Anda harus mengisi detail warta.']);
        }

        $wartaJemaat = WartaJemaat::findOrFail($id);
        $wartaJemaat->update([
            'judul' => $validatedData['judul'],
            'tanggal' => $validatedData['tanggal'],
            'judul_renungan' => $validatedData['judul_renungan'],
            'isi_renungan' => $validatedData['isi_renungan'],
            'penkotbah' => $validatedData['penkotbah'],
            'deskripsi_pengumuman' => $validatedData['deskripsi_pengumuman'],
        ]);

        $wartaJemaat->detailWartas()->delete();

        foreach ($validatedData['header'] as $index => $header) {
            DetailWartaJemaat::create([
                'warta_jemaat_id' => $wartaJemaat->id,
                'header' => $header,
                'isi' => $validatedData['isi'][$index],
            ]);
        }

        Alert::success('Berhasil', 'Warta Jemaat telah diubah!');
        return redirect('/wartajemaat')->with('success', 'Warta Jemaat telah diubah!');
    }

    public function destroy($id)
    {
        $wartaJemaat = WartaJemaat::findOrFail($id);
        $wartaJemaat->delete();

        Alert::success('Berhasil', 'Data Berhasil Dihapus');
        return redirect('/wartajemaat')->with('status', 'Data Berhasil Dihapus');
    }

    public function downloadPdf($id)
    {
        $warta = WartaJemaat::with(['detailWartas', 'user', 'keuangan'])->findOrFail($id);

        $user_id = $warta->user_id;

        $pemasukan = Keuangan::where('user_id', $user_id)->where('kategori', 'pemasukan')->get();
        $pengeluaran = Keuangan::where('user_id', $user_id)->where('kategori', 'pengeluaran')->get();

        return view('modules.admin.warta.pdf', compact('warta', 'pemasukan', 'pengeluaran'));

        // $pdf = PDF::loadView('modules.admin.warta.pdf', compact('warta', 'pemasukan', 'pengeluaran'));

        // $pdf->setOption('isHtml5ParserEnabled', true);

        // $pdf->setOption('isPhpEnabled', true);



        // // Pilih ukuran kertas yang sesuai dengan booklet (A4 contohnya)

        // $pdf->setPaper('A4', 'portrait');



        // // Mengatur margin untuk booklet

        // $pdf->setOption('margin-top', 10);

        // $pdf->setOption('margin-bottom', 10);

        // return $pdf->download('Warta_Jemaat_' . $id . '.pdf');

    }




    public function deleteDetail($id)
    {
        $detail = DetailWartaJemaat::find($id);

        if ($detail) {
            $detail->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
