<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan {{ $bulan }} - {{ $tahun }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        h3 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h3>Laporan Keuangan Gereja - {{ $bulan }} - {{ $tahun }}</h3>

    <h4>Pemasukan</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemasukan as $key => $transaction)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaction->tanggal)->format('d-m-Y') }}</td>
                    <td>
                        @foreach(json_decode($transaction->details) as $detail)
                            <p>{{ $detail->header }}</p>
                        @endforeach
                    </td>
                    <td class="text-center">
                                                                                                                @php
                                                                                                                    $totalNominal = 0;
                                                                                                                    foreach (json_decode($transaction->details) as $detail) {
                                                                                                                        $totalNominal += $detail->nominal;
                                                                                                                    }
                                                                                                                @endphp
                                                                                                                {{ number_format($totalNominal, 2) }}
                                                                                                            </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Pengeluaran</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengeluaran as $key => $transaction)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaction->tanggal)->format('d-m-Y') }}</td>
                    <td>
                        @foreach(json_decode($transaction->details) as $detail)
                            <p>{{ $detail->header }}</p>
                        @endforeach
                    </td>
                    <td class="text-center">
                                                                                                                @php
                                                                                                                    $totalNominal = 0;
                                                                                                                    foreach (json_decode($transaction->details) as $detail) {
                                                                                                                        $totalNominal += $detail->nominal;
                                                                                                                    }
                                                                                                                @endphp
                                                                                                                {{ number_format($totalNominal, 2) }}
                                                                                                            </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Total Keuangan</h4>
    <p><strong>Total Pemasukan: </strong>{{ number_format($totalPemasukan, 2) }}</p>
    <p><strong>Total Pengeluaran: </strong>{{ number_format($totalPengeluaran, 2) }}</p>
    <p><strong>Sisa Uang: </strong>{{ number_format($sisaUang, 2) }}</p>
</body>
</html>
