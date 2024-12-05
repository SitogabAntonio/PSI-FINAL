<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Keuangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        .custom-card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .custom-table th,
        .custom-table td {
            text-align: center;
            padding: 12px 15px;
        }

        .custom-table th {
            background-color: #f8f9fa;
            font-weight: bold;
            border-top: 2px solid #ddd;
        }

        .custom-table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .custom-btn {
            font-size: 16px;
            padding: 10px 25px;
            transition: background-color 0.3s ease;
        }

        .custom-btn:hover {
            background-color: #007bff;
            color: #fff;
        }

        .custom-card .fw-bold {
            font-size: 1.1em;
            color: #fff;
            background-color: #ff5733;
            padding: 0.5em 1em;
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            .custom-card {
                margin-bottom: 15px;
            }

            .custom-table th,
            .custom-table td {
                font-size: 14px;
            }

            .custom-btn {
                padding: 8px 20px;
            }
        }
    </style>
</head>

<body>

    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Laporan Keuangan Gereja</h5>

                            <h6>Pemasukan</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Kategori</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pemasukan as $key => $transaction)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($transaction->tanggal)->format('d-m-Y') }}</td>
                                            <td class="text-center">{{ ucfirst($transaction->kategori) }}</td>
                                            <td class="text-center">
                                                <a href="#" class="badge bg-info me-2 custom-badge" data-toggle="modal" data-target="#detail-{{ $transaction->id }}">
                                                    Lihat
                                                </a>
                                                <a href="/keuangan/destroy/{{$transaction->id}}" class="badge bg-danger custom-badge" onclick="return confirm('Yakin ingin menghapus?');">
                                                    Hapus
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if($pemasukan->isEmpty())
                                <p class="text-center">Tidak ada data pemasukan.</p>
                                @endif
                            </div>
                            <!-- Pagination -->
                            <div class="pagination-container">
                                {{ $pemasukan->links() }}
                            </div>
                            <!-- Modal for each transaction -->
                            @foreach ($pemasukan as $data)
                            <div id="detail-{{ $data->id }}" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Transaksi Keuangan</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h6>Tanggal: {{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</h6>
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            @php
                                                            // Decode JSON string into PHP array
                                                            $details = json_decode($data->details, true);
                                                            $total = 0;
                                                            @endphp
                                                            @foreach($details as $detail)
                                                            <tr>
                                                                <td><strong>{{ ucfirst($detail['header']) }}</strong></td>
                                                                <td>Rp. {{ number_format($detail['nominal'], 0, ',', '.') }}</td>
                                                            </tr>
                                                            @php
                                                            $total += $detail['nominal'];
                                                            @endphp
                                                            @endforeach
                                                            <tr>
                                                                <td><strong>Total</strong></td>
                                                                <td>Rp. {{ number_format($total, 0, ',', '.') }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <hr>

                            <!-- Tabel Pengeluaran -->
                            <h6>Pengeluaran</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Kategori</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pengeluaran as $key => $transaction)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($transaction->tanggal)->format('d-m-Y') }}</td>
                                            <td class="text-center">{{ ucfirst($transaction->kategori) }}</td>
                                            <td class="text-center">
                                                <a href="#" class="badge bg-info me-2 custom-badge" data-toggle="modal" data-target="#detail-{{ $transaction->id }}">
                                                    Lihat
                                                </a>
                                                <a href="/keuangan/destroy/{{$transaction->id}}" class="badge bg-danger custom-badge" onclick="return confirm('Yakin ingin menghapus?');">
                                                    Hapus
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if($pengeluaran->isEmpty())
                                <p class="text-center">Tidak ada data pengeluaran.</p>
                                @endif
                            </div>
                            <!-- Pagination -->
                            <div class="pagination-container">
                                {{ $pengeluaran->links() }}
                            </div>
                            <!-- Modal for each transaction -->
                            @foreach ($pengeluaran as $data)
                            <div id="detail-{{ $data->id }}" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Transaksi Keuangan</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h6>Tanggal: {{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</h6>
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            @php
                                                            // Decode JSON string into PHP array
                                                            $details = json_decode($data->details, true);
                                                            $total = 0;
                                                            @endphp
                                                            @foreach($details as $detail)
                                                            <tr>
                                                                <td><strong>{{ ucfirst($detail['header']) }}</strong></td>
                                                                <td>Rp. {{ number_format($detail['nominal'], 0, ',', '.') }}</td>
                                                            </tr>
                                                            @php
                                                            $total += $detail['nominal'];
                                                            @endphp
                                                            @endforeach
                                                            <tr>
                                                                <td><strong>Total</strong></td>
                                                                <td>Rp. {{ number_format($total, 0, ',', '.') }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
