<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WartaJemaat;
use App\Models\Keuangan;
use Illuminate\Http\Request;
use PDF;

class WelcomeController extends Controller
{

    public function showGerejaDetail($domain)
    {
        $gereja = User::where('domain', $domain)
            ->with(['sejarah', 'visi', 'misi', 'organisasiGereja']) // Muat semua relasi terkait
            ->first();

        if (!$gereja) {
            abort(404, 'Gereja tidak ditemukan.');
        }

        // Ambil data organisasi gereja
        $bphList = $gereja->organisasiGereja ?? collect(); // Gunakan `collect()` jika data kosong

        return view('/modules/client/main', compact('gereja', 'bphList'));
    }



    public function showGerejaDetailEvent($domain)
    {
        $gereja = User::where('domain', $domain)
            ->with(['events'])
            ->first();

        if (!$gereja) {
            abort(404, 'Gereja tidak ditemukan.');
        }
        $events = $gereja->events()->paginate(5)->withQueryString();
        return view('/modules/client/event', compact('gereja', 'events'));
    }

    public function showGerejaDetailAyat($domain)
    {
        $gereja = User::where('domain', $domain)
            ->with(['ayatharians'])
            ->first();
        if (!$gereja) {
            abort(404, 'Ayat tidak ditemukan.');
        }

        // Mengambil ayat harian dan mengurutkan berdasarkan kolom `tanggal`
        $ayats = $gereja->ayatharians()->orderBy('tanggal', 'desc')->get();

        // Menampilkan ayat terbaru berdasarkan `tanggal`
        $currentAyat = $ayats->first();

        return view('/modules/client/ayat', compact('gereja', 'ayats', 'currentAyat'));
    }

    public function showGerejaDetailWarta($domain)
    {
        $gereja = User::where('domain', $domain)
            ->with(['wartaJemaats'])
            ->first();
        if (!$gereja) {
            abort(404, 'Warta tidak ditemukan.');
        }
        $wartas = $gereja->wartaJemaats()->paginate(5);
        return view('/modules/client/warta', compact('gereja', 'wartas'));
    }


    public function showGerejaDetailSukaduka($domain)
    {
        $gereja = User::where('domain', $domain)
            ->with(['sukaDukaCitas'])
            ->first();
        if (!$gereja) {
            abort(404, 'Suka Duka Cita tidak ditemukan.');
        }
        $sukadukas = $gereja->sukaDukaCitas()->paginate(5);
        return view('/modules/client/sukaduka', compact('gereja', 'sukadukas'));
    }

    public function informasiGereja()
    {
        $getallinformasi = User::with(['ayatHarians', 'organisasiGereja', 'events', 'wartaJemaats', 'sukaDukaCitas'])
            ->latest()
            ->filter(request(['search']))
            ->paginate(5)
            ->withQueryString();

        return view('/modules/client/informasi/main', compact('getallinformasi'));
    }

    public function showGereja($id)
    {
        $gereja = User::with(['ayatharians', 'organisasiGereja', 'events', 'wartaJemaats', 'sukaDukaCitas'])
            ->findOrFail($id);

        $gereja->ayatharians = $gereja->ayatharians()->paginate(10);

        $gereja->events = $gereja->events()->paginate(10);

        $gereja->sukadukacitas = $gereja->sukadukacitas()->paginate(10);

        $gereja->wartaJemaats = $gereja->wartaJemaats()->paginate(10);

        return view('/modules/client/informasi/detailgereja', compact('gereja'));
    }


    public function tantangsigra()
    {
        return view('/modules/client/about/main');
    }

    public function faqsigra()
    {
        return view('/modules/client/faq/main');
    }


    public function downloadPDF($id)
    {
        $warta = WartaJemaat::with(['detailWartas', 'user', 'keuangan'])->findOrFail($id);

        $user_id = $warta->user_id;

        $pemasukan = Keuangan::where('user_id', $user_id)->where('kategori', 'pemasukan')->get();
        $pengeluaran = Keuangan::where('user_id', $user_id)->where('kategori', 'pengeluaran')->get();

        $pdf = PDF::loadView('modules/client/pdf', compact('warta', 'pemasukan', 'pengeluaran'));

        return $pdf->download('Warta_Jemaat_' . $id . '.pdf');
    }
}
