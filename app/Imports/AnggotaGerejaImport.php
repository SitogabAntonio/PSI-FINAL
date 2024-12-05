<?php

namespace App\Imports;

use App\Models\AnggotaGereja;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnggotaGerejaImport implements ToCollection, WithHeadingRow
{
    /**
     * Proses collection data yang diambil dari file Excel.
     *
     * @param Collection $collection
     * @return void
     */
    public function collection(Collection $collection)
    {
        // Mengiterasi setiap baris data dari Excel
        foreach ($collection as $row) {
            // Pastikan hanya data yang valid yang diproses (misalnya pastikan semua kolom ada)
            AnggotaGereja::create([
                'keluarga' => $row['keluarga'],    // Sesuaikan dengan nama kolom di Excel
                'no_kk' => $row['no_kk'],          // Sesuaikan dengan nama kolom di Excel
                'nama' => $row['nama'],            // Sesuaikan dengan nama kolom di Excel
                'user_id' => auth()->id(),         // Menyimpan user yang mengupload data
            ]);
        }
    }
}
