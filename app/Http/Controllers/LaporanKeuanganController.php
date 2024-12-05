<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keuangan;
use PDF;

class LaporanKeuanganController extends Controller
{
    public function index(Request $request)
    {
        // Ambil bulan dan tahun dari request
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Query dasar untuk pemasukan dan pengeluaran
        $queryPemasukan = Keuangan::where('kategori', 'pemasukan');
        $queryPengeluaran = Keuangan::where('kategori', 'pengeluaran');

        // Filter bulan dan tahun jika ada
        if ($bulan && $tahun) {
            $queryPemasukan = $queryPemasukan->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
            $queryPengeluaran = $queryPengeluaran->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }

        // Ambil data dengan pagination
        $pemasukan = $queryPemasukan->paginate(10);
        $pengeluaran = $queryPengeluaran->paginate(10);

        return view('modules.admin.laporankeuangan.index', compact('pemasukan', 'pengeluaran'));
    }

    public function downloadLaporanPdf(Request $request)
{
    // Ambil bulan dan tahun dari request
    $bulan = $request->input('bulan');
    $tahun = $request->input('tahun');

    // Membuat query dasar untuk pemasukan dan pengeluaran
    $queryPemasukan = Keuangan::where('kategori', 'pemasukan');
    $queryPengeluaran = Keuangan::where('kategori', 'pengeluaran');

    // Jika bulan dan tahun dipilih, tambahkan kondisi untuk memfilter berdasarkan bulan dan tahun
    if ($bulan && $tahun) {
        $queryPemasukan = $queryPemasukan->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        $queryPengeluaran = $queryPengeluaran->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
    }

    // Ambil data pemasukan dan pengeluaran
    $pemasukan = $queryPemasukan->get();
    $pengeluaran = $queryPengeluaran->get();

    // Hitung total pemasukan dan pengeluaran
    $totalPemasukan = $pemasukan->reduce(function ($total, $transaction) {
        $details = json_decode($transaction->details, true);
        $nominalTotal = array_sum(array_column($details, 'nominal'));
        return $total + $nominalTotal;
    }, 0);

    $totalPengeluaran = $pengeluaran->reduce(function ($total, $transaction) {
        $details = json_decode($transaction->details, true);
        $nominalTotal = array_sum(array_column($details, 'nominal'));
        return $total + $nominalTotal;
    }, 0);

    // Hitung sisa uang
    $sisaUang = $totalPemasukan - $totalPengeluaran;

    // Membuat PDF menggunakan view dan data yang telah disiapkan
    $pdf = PDF::loadView('modules.admin.laporankeuangan.pdf', [
        'pemasukan' => $pemasukan,
        'pengeluaran' => $pengeluaran,
        'totalPemasukan' => $totalPemasukan,
        'totalPengeluaran' => $totalPengeluaran,
        'sisaUang' => $sisaUang,
        'bulan' => $bulan,
        'tahun' => $tahun,
    ]);

    // Download file PDF
    return $pdf->download("Laporan_Keuangan_{$bulan}_{$tahun}.pdf");
}

}
