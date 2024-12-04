<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GKII</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700"
        rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="css/style.css" rel="stylesheet">

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        img {
            max-width: 150px;
            margin-right: 20px;
        }

        .keuangan-table {
            width: auto;
            font-size: 0.8em;
            margin: 20px 0;
        }

        .keuangan-table th,
        .keuangan-table td {
            padding: 5px;
        }

        .isi-cell {
            word-wrap: break-word;
            white-space: pre-wrap;
            line-height: 1.6;
        }

        .container {
            display: grid;
            grid-template-columns: 1fr 1fr; /* Create two equal columns */
            gap: 50px; /* Space between columns */
        }

        .column {
            padding: 10px;
        }

        @media (max-width: 100%) {
            .container {
                grid-template-columns: 1fr 1fr; /* Stack columns on small screens */
            }
        }
    </style>
</head>

<body>
    <header id="header">
        <table border="1" style="width: 100%; text-align: center; border-collapse: separate; border-spacing: 5px; border: 1px solid transparent;">
            <tr>
                <td style="width: 15%; vertical-align: middle; border: 1px solid transparent;">
                    <div class="image-container">
                        @if($warta->user->image)
                        <img src="data:image/jpeg;base64,{{ $warta->user->image }}" alt="User Image" width="100">
                        @endif
                    </div>
                </td>
                <td style="width: 35%; vertical-align: middle; border: 1px; background-color: #f0f0f0;">
                    <div class="info_mingguan">
                        <h3 style="font-size: 1em; font-weight: bold;">Tahun 2024<br>The Year Beyond Expectation Multiple Wonders</h3>
                    </div>
                </td>
                <td style="width: 35%; vertical-align: middle; border: 1px; background-color: #f0f0f0;">
                    <div class="info_gereja">
                        <h3>
                            {{$warta->user->name}}<br>
                            <span style="font-size: 0.6em;">{{$warta->user->location}}</span>
                        </h3>
                    </div>
                </td>
            </tr>
        </table>

        <table border="1" style="width: 100%; text-align: center; border-collapse: separate; border-spacing: 5px; border: 1px solid transparent; margin-top: -20px;">
            <tr>
                <td style="width: 17%; vertical-align: middle; border: 1px solid transparent;">
                    <div class="image-container">
                    </div>
                </td>
                <td style="width: 35%; vertical-align: middle; border: 1px solid transparent;">
                    <div class="info_mingguan">
                        <h3 style="font-size: 0.9em; font-weight: bold;">{{$warta->judul}}</h3>
                    </div>
                </td>

                <td style="width: 35%; vertical-align: middle; border: 1px solid transparent;">
                    <div class="info_gereja">
                        <h3 style="font-size: 0.9em; font-weight: bold; font-style: italic; margin: 0; background-color: rgba(0, 0, 255, 0.5); display: inline;">
                            Berita Iman {{ \Carbon\Carbon::parse($warta->tanggal)->isoFormat('DD MMMM YYYY') }}<br>
                        </h3>
                    </div>
                </td>

            </tr>
        </table>
        <hr>
    </header>

    <section style="margin-top: 5px; ">
        <div class="container-fluid">
            <div class="row">
                <div class="col col-lg-6" style="background-color:white; margin-top: 5px;">
                    <div class="col-md-12" style="background: url(img/transparan.png) no-repeat center fixed; background-size: 400px;">
                        <table style="width: 100%; text-align: center; border-collapse: collapse;">
                            <tr>
                                <td style="text-align: center; width: 50%; padding-left: 10%; padding-right: 10%;">
                                    <h1 style="margin: 0; font-size: 1.2em;">{{$warta->judul_renungan}}</h1>
                                </td>
                                <td style="text-align: right; width: 50%;">
                                    <h3 style="margin: 0; background-color: yellow; font-size: 0.8em; text-align: center;">
                                        <span style="text-decoration: underline;">{{$warta->penkotbah}}</span><br>
                                        <span style="font-size: 0.6em;">(Gembala Sidang)</span>
                                    </h3>

                                </td>
                            </tr>
                        </table>
                        <hr>
                        <br>
                        <div class="container">
                            <div class="coloumn">
                                {!! $warta->isi_renungan !!}
                            </div>

                            <div class="coloumn">
                                <div style="flex: 1; padding: 10px;">
                                    <div class="tittle text-center" style="align-items: center; text-align:center;">
                                        <h4>PENGUMUMAN</h4>
                                    </div>
                                    {!! $warta->deskripsi_pengumuman !!}
                                </div>
                            </div>
                        </div>

                        {{-- <table style="width: 100%; text-align: center; border-collapse: collapse; ">
                            
                        </table> --}}

                        {{-- <div class="row" style="margin-top: 10px; margin-bottom: 10px; text-align: justify;">
                            <div class="col-6">
                                {!! $warta->isi_renungan !!}
                            </div>

                            <div class="col-6">
                                <div class="tittle text-center" style="align-items: center; text-align:center;">
                                    <h4>PENGUMUMAN</h4>
                                </div>
                                <div class="row" style="margin-top: 10px; margin-bottom: 10px; text-align: justify;">
                                    <div class="col">
                                        {!! $warta->deskripsi_pengumuman !!}
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        @if($warta->detailWartas != null)
                            <div class="row" style="margin-top: 5px; text-align: justify;">
                                <div class="col">
                                    <ol start="1">
                                    
                                            @foreach ($warta->detailWartas as $index => $detail)
                                            <li>
                                                <strong>{{ $detail->header }}</strong><br>
                                                {!! $detail->isi !!}
                                            </li>
                                            @endforeach
                                    </ol>
                                </div>
                            </div>
                        @endif

                        <h3>Laporan Keuangan</h3>
                        <table style="width: 100%; border-collapse: collapse; border: 1px solid black;">
                            <thead style="background-color: #D3D3D3;">
                                <tr>
                                    <th style="border: 1px solid black; padding: 8px; text-align: left;">Tanggal</th>
                                    <th style="border: 1px solid black; padding: 8px; text-align: left;">Kategori</th>
                                    <th style="border: 1px solid black; padding: 8px; text-align: left;">Keterangan</th>
                                    <th style="border: 1px solid black; padding: 8px; text-align: left;">Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $totalPemasukan = 0;
                                $totalPengeluaran = 0;
                                @endphp

                                @foreach ($pemasukan as $item)
                                @php
                                $details = json_decode($item->details, true);
                                @endphp
                                @foreach ($details as $detail)
                                <tr>
                                    <td style="border: 1px solid black; padding: 8px;">{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('DD MMMM YYYY') }}</td>
                                    <td style="border: 1px solid black; padding: 8px; color: blue;">Pemasukan</td>
                                    <td style="border: 1px solid black; padding: 8px;">{{ $detail['header'] }}</td>
                                    <td style="border: 1px solid black; padding: 8px;">Rp. {{ number_format($detail['nominal'], 0, ',', '.') }}</td>
                                </tr>
                                @php
                                $totalPemasukan += $detail['nominal'];
                                @endphp
                                @endforeach
                                @endforeach

                                @foreach ($pengeluaran as $item)
                                @php
                                $details = json_decode($item->details, true);
                                @endphp
                                @foreach ($details as $detail)
                                <tr>
                                    <td style="border: 1px solid black; padding: 8px;">{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('DD MMMM YYYY') }}</td>
                                    <td style="border: 1px solid black; padding: 8px; color: #FF0000;">Pengeluaran</td>
                                    <td style="border: 1px solid black; padding: 8px;">{{ $detail['header'] }}</td>
                                    <td style="border: 1px solid black; padding: 8px;">Rp. {{ number_format($detail['nominal'], 0, ',', '.') }}</td>
                                </tr>
                                @php
                                $totalPengeluaran += $detail['nominal'];
                                @endphp
                                @endforeach
                                @endforeach

                                <tr class="total">
                                    <td colspan="3" style="border: 1px solid black; padding: 8px; text-align: right;">Total Pemasukan</td>
                                    <td style="border: 1px solid black; padding: 8px;">Rp. {{ number_format($totalPemasukan, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="total">
                                    <td colspan="3" style="border: 1px solid black; padding: 8px; text-align: right;">Total Pengeluaran</td>
                                    <td style="border: 1px solid black; padding: 8px;">Rp. {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="total" style="background-color: #90EE90;">
                                    <td colspan="3" style="border: 1px solid black; padding: 8px; text-align: right;">Saldo Akhir</td>
                                    <td style="border: 1px solid black; padding: 8px;">Rp. {{ number_format($totalPemasukan - $totalPengeluaran, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
        </div>

    </section>
    </main>

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/superfish/hoverIntent.js"></script>
    <script src="lib/superfish/superfish.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/touchSwipe/jquery.touchSwipe.min.js"></script>
    <!-- Contact Form JavaScript File -->
    <script src="contactform/contactform.js"></script>

    <!-- Template Main Javascript File -->
    <script src="js/main.js"></script>

</body>

</html>