<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        table {
            max-width: 600px;
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 3px;
            text-align: center;
            font-size: 12px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Laporan Keuangan</h1>
    <h5 class="mb-0">Total Kas:
        @php
            $currentMonth = now()->format('F'); 
        @endphp
        Rp. {{ number_format(($totalKas->$currentMonth ?? 0) - ($pengeluaranTotal->$currentMonth ?? 0), 0, ',', '.') }}
        ({{ $currentMonth }})
    </h5>
    <h3>Total Kas Per Bulan</h3>
    <table>
        <thead>
            <tr>
                @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $month)
                    <th>{{ $month }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $month)
                    <td>Rp. {{ number_format($totalKas->$month ?? 0, 0, ',', '.') }}</td>
                @endforeach
            </tr>
        </tbody>
    </table>

    <h3>Total Pengeluaran Per Bulan</h3>
    <table>
        <thead>
            <tr>
                @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $month)
                    <th>{{ $month }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $month)
                    <td>Rp. {{ number_format($pengeluaranTotal->$month ?? 0, 0, ',', '.') }}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
    <div class="card mt-3">
        <div class="card-header">
            <h5 class="mb-0">Total Kas Setelah Pemasukan dan Pengeluaran</h5>
        </div>
        <div class="card-body">
            <p class="text-center">
                Total Kas:
                Rp.
                {{ number_format(($totalKas->$currentMonth ?? 0) - ($pengeluaranTotal->$currentMonth ?? 0), 0, ',', '.') }}
                ({{ $currentMonth }})
            </p>
        </div>
    </div>
</body>

</html>