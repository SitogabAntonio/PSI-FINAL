<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Keuangan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class KeuanganController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userId = auth()->user()->id;

        $kategori = request('kategori');

        $keuanganQuery = Keuangan::where('user_id', $userId);

        if ($kategori) {
            $keuanganQuery->where('kategori', $kategori);
        }

        $keuangan = $keuanganQuery->latest()
            ->filter(request(['search']))
            ->paginate(5)
            ->withQueryString();

        return view('modules.admin.keuangan.index', compact('keuangan', 'userId'));
    }


    public function create()
    {
        return view('modules.admin.keuangan.create', [
            'active' => 'createkeuangan',
            'title' => 'Tambah Data Keuangan',
        ]);
    }

    public function store(Request $request)
    {
        $nominals = array_map(function ($value) {
            return $this->removeCurrencyFormat($value);
        }, $request->input('nominal', []));

        $headers = $request->input('header', []);

        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'kategori' => 'required|in:pemasukan,pengeluaran',
            'header.*' => 'required|string',
            'nominal.*' => 'nullable|numeric',
        ]);

        $kategori = $validatedData['kategori'];

        $keuangan = new Keuangan();
        $keuangan->user_id = auth()->user()->id;
        $keuangan->tanggal = $validatedData['tanggal'];
        $keuangan->kategori = $kategori;
        $details = [];
        foreach ($headers as $index => $header) {
            $nominal = isset($nominals[$index]) ? (float)$nominals[$index] : 0;

            $details[] = [
                'header' => $header,
                'nominal' => $nominal,
            ];
        }

        $keuangan->details = json_encode($details);
        $keuangan->save();

        return redirect('/keuangan')->with('success', 'Data Keuangan telah ditambahkan!');
    }

    public function saveUpdateKeuangan(Request $request, $id)
    {
        $nominals = array_map([$this, 'removeCurrencyFormat'], $request->input('nominal', []));
        $headers = $request->input('header', []);

        $validatedData = $request->validate([
            'header.*' => 'required|string',
            'nominal.*' => 'nullable|numeric',
            'tanggal' => 'required|date',
        ]);

        $keuangan = Keuangan::findOrFail($id);

        $keuangan->update([
            'user_id' => auth()->user()->id,
            'tanggal' => $validatedData['tanggal'],
        ]);

        $details = [];
        foreach ($headers as $index => $header) {
            $nominal = isset($nominals[$index]) ? (float)$nominals[$index] : 0;

            $details[] = [
                'header' => $header,
                'nominal' => $nominal,
            ];
        }

        $keuangan->details = json_encode($details);
        $keuangan->save();

        return redirect('/keuangan')->with('success', 'Data Keuangan telah diubah!');
    }

    public function destroy($id)
    {
        Keuangan::destroy($id);
        return redirect('/keuangan')->with('status', 'Data Berhasil DiHapus');
    }

    public function downloadPDF($id)
    {
        $pemasukan = Keuangan::where('user_id', $id)->where('kategori', 'pemasukan')->get();
        $pengeluaran = Keuangan::where('user_id', $id)->where('kategori', 'pengeluaran')->get();

        $totalPemasukan = $pemasukan->sum(function ($item) {
            return collect(json_decode($item->details))->sum('nominal');
        });
        $totalPengeluaran = $pengeluaran->sum(function ($item) {
            return collect(json_decode($item->details))->sum('nominal');
        });

        $pdf = PDF::loadView('modules.admin.keuangan.pdf', compact('pemasukan', 'pengeluaran', 'totalPemasukan', 'totalPengeluaran'));

        return $pdf->download('Laporan_Keuangan.pdf');
    }


    private function removeCurrencyFormat($value)
    {
        if ($value === null) {
            return null;
        }

        $numericValue = preg_replace('/\D/', '', $value);

        return $numericValue !== '' ? (float)$numericValue : null;
    }
}
