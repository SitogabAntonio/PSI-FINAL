<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warta Jemaat</title>
    <!-- Link to your CSS or Bootstrap here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom Styles */
        .card {
            border-radius: 8px;
            overflow: hidden;
            background-color: #f9f9f9;
        }

        .card-header {
            background-color: #343a40;
            color: #ffffff;
            font-size: 1.25rem;
            font-weight: bold;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.15rem;
            color: #343a40;
        }

        .table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }

        .table td {
            max-width: 300px;
            word-wrap: break-word;
            white-space: normal;
        }

        .card-footer {
            background-color: #ffffff;
            border-top: 1px solid #e0e0e0;
        }

        .badge {
            font-size: 0.875rem;
            text-align: center;
            padding: 8px 12px;
            text-decoration: none;
        }

        .badge.bg-danger {
            background-color: #dc3545;
            border-radius: 25px;
        }

        .card-footer a:hover {
            text-decoration: none;
            background-color: #c82333;
        }

        .container {
            padding: 0 15px;
        }

        .shadow-lg {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .shadow-sm {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 767px) {
            .card-title {
                font-size: 1rem;
            }

            .table {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4 shadow-lg">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 text-primary">Warta Jemaat Yang Terdaftar</h5>
                        </div>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    @foreach($wartajemaatsuperadmin as $key => $item)
                                    <div class="col-md-12 mb-4">
                                        <div class="card h-100 shadow-sm">
                                            <div class="card-body">
                                                <h5 class="card-title text-dark">{{ $item->judul }} - <span
                                                        class="text-muted">{{ $item->tanggal }}</span></h5>
                                                <table class="table table-striped">
                                                    <tbody>
                                                        @foreach($item->detailWartas as $detail)
                                                        <tr>
                                                            <td><strong>{{ $detail->header }}</strong></td>
                                                            <td>{{ $detail->isi }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="card-footer d-flex justify-content-end">
                                                <a href="{{ url('/wartajemaat/superadmin/detele', $item->id) }}"
                                                    class="badge bg-danger text-white py-2 px-3 rounded-3"
                                                    style="text-decoration: none;">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @if($wartajemaatsuperadmin->isEmpty())
                                <p class="text-center">Tidak ada data Warta Jemaat.</p>
                                @endif
                            </div>
                        </div>
                        <br>
                        {{ $wartajemaatsuperadmin->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>