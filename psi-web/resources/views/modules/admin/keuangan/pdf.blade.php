<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h1 {
            text-align: center;
            font-size: 16px;
        }

        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
            font-size: 12px;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            font-weight: bold;
            background-color: #e0e0e0;
        }
    </style>
</head>

<body>
    <h1>Laporan Keuangan</h1>
    <h2 style="text-align: center;">Pemasukan</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
            @php $totalPemasukan = 0; @endphp
            @foreach ($pemasukan as $item)
            @php
            $details = json_decode($item->details, true);
            @endphp
            @foreach ($details as $detail)
            <tr>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                <td>{{ $detail['header'] }}</td>
                <td>Rp. {{ number_format($detail['nominal'], 0, ',', '.') }}</td>
            </tr>
            @php $totalPemasukan += $detail['nominal']; @endphp
            @endforeach
            @endforeach
            <tr class="total">
                <td colspan="2">Total Pemasukan</td>
                <td>Rp. {{ number_format($totalPemasukan, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h2 style="text-align: center;">Pengeluaran</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
            @php $totalPengeluaran = 0; @endphp
            @foreach ($pengeluaran as $item)
            @php
            $details = json_decode($item->details, true);
            @endphp
            @foreach ($details as $detail)
            <tr>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                <td>{{ $detail['header'] }}</td>
                <td>Rp. {{ number_format($detail['nominal'], 0, ',', '.') }}</td>
            </tr>
            @php $totalPengeluaran += $detail['nominal']; @endphp
            @endforeach
            @endforeach
            <tr class="total">
                <td colspan="2">Total Pengeluaran</td>
                <td>Rp. {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h2 style="text-align: center;">Saldo Akhir</h2>
    <table>
        <tbody>
            <tr class="total">
                <td>Saldo Akhir</td>
                <td>Rp. {{ number_format($totalPemasukan - $totalPengeluaran, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

</body>

</html>