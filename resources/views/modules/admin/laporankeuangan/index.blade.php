@extends('layouts.user_type.auth')

@section('content')
<div class="card-body">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Keuangan Gereja</h5>

                        <!-- Filter Bulan dan Tahun -->
                        <form method="GET" action="{{ url()->current() }}">
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <select class="form-control" name="bulan" required>
                                        <option value="">Pilih Bulan</option>
                                        <option value="01" {{ request('bulan') == '01' ? 'selected' : '' }}>Januari
                                        </option>
                                        <option value="02" {{ request('bulan') == '02' ? 'selected' : '' }}>Februari
                                        </option>
                                        <option value="03" {{ request('bulan') == '03' ? 'selected' : '' }}>Maret</option>
                                        <option value="04" {{ request('bulan') == '04' ? 'selected' : '' }}>April</option>
                                        <option value="05" {{ request('bulan') == '05' ? 'selected' : '' }}>Mei</option>
                                        <option value="06" {{ request('bulan') == '06' ? 'selected' : '' }}>Juni</option>
                                        <option value="07" {{ request('bulan') == '07' ? 'selected' : '' }}>Juli</option>
                                        <option value="08" {{ request('bulan') == '08' ? 'selected' : '' }}>Agustus
                                        </option>
                                        <option value="09" {{ request('bulan') == '09' ? 'selected' : '' }}>September
                                        </option>
                                        <option value="10" {{ request('bulan') == '10' ? 'selected' : '' }}>Oktober
                                        </option>
                                        <option value="11" {{ request('bulan') == '11' ? 'selected' : '' }}>November
                                        </option>
                                        <option value="12" {{ request('bulan') == '12' ? 'selected' : '' }}>Desember
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" name="tahun" required>
                                        <option value="">Pilih Tahun</option>
                                        @foreach(range(date('Y'), 2010) as $year)
                                            <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Terapkan</button>
                                </div>
                            </div>
                        </form>


                        <!-- Tabs for Pemasukan, Pengeluaran, and Total -->
                        <ul class="nav nav-tabs" id="financialTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pemasukan-tab" data-bs-toggle="tab" href="#pemasukan"
                                    role="tab" aria-controls="pemasukan" aria-selected="true">Pemasukan</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pengeluaran-tab" data-bs-toggle="tab" href="#pengeluaran"
                                    role="tab" aria-controls="pengeluaran" aria-selected="false">Pengeluaran</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="total-tab" data-bs-toggle="tab" href="#total" role="tab"
                                    aria-controls="total" aria-selected="false">Total</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="financialTabsContent">
                            <!-- Tab Pemasukan -->
                            <div class="tab-pane fade show active" id="pemasukan" role="tabpanel"
                                aria-labelledby="pemasukan-tab">
                                <h6>Pemasukan</h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th class="text-center">Tanggal</th>
                                                <th class="text-center">Kategori</th>
                                                <th class="text-center">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $totalPemasukan = 0;
                                            @endphp
                                            @foreach($pemasukan as $key => $transaction)
                                                                                        <tr>
                                                                                            <td>{{ $key + 1 }}</td>
                                                                                            <td class="text-center">
                                                                                                {{ \Carbon\Carbon::parse($transaction->tanggal)->format('d-m-Y') }}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                @php
                                                                                                    $totalNominal = 0;
                                                                                                @endphp
                                                                                                @foreach(json_decode($transaction->details) as $detail)
                                                                                                                                                <p>{{ $detail->header }}</p>
                                                                                                                                                @php
                                                                                                                                                    $totalNominal += $detail->nominal;
                                                                                                                                                @endphp
                                                                                                @endforeach
                                                                                            </td>
                                                                                            <td class="text-center">{{ number_format($totalNominal, 2) }}</td>
                                                                                        </tr>
                                                                                        @php
                                                                                            $totalPemasukan += $totalNominal;
                                                                                        @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @if($pemasukan->isEmpty())
                                        <p class="text-center">Tidak ada data pemasukan.</p>
                                    @endif
                                </div>
                                <div class="text-end">
                                    <strong>Total Pemasukan: </strong>{{ number_format($totalPemasukan, 2) }}
                                </div>
                            </div>

                            <!-- Tab Pengeluaran -->
                            <div class="tab-pane fade" id="pengeluaran" role="tabpanel"
                                aria-labelledby="pengeluaran-tab">
                                <h6>Pengeluaran</h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th class="text-center">Tanggal</th>
                                                <th class="text-center">Kategori</th>
                                                <th class="text-center">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $totalPengeluaran = 0;
                                            @endphp
                                            @foreach($pengeluaran as $key => $transaction)
                                                                                        <tr>
                                                                                            <td>{{ $key + 1 }}</td>
                                                                                            <td class="text-center">
                                                                                                {{ \Carbon\Carbon::parse($transaction->tanggal)->format('d-m-Y') }}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                @php
                                                                                                    $totalNominal = 0;
                                                                                                @endphp
                                                                                                @foreach(json_decode($transaction->details) as $detail)
                                                                                                                                                <p>{{ $detail->header }}</p>
                                                                                                                                                @php
                                                                                                                                                    $totalNominal += $detail->nominal;
                                                                                                                                                @endphp
                                                                                                @endforeach
                                                                                            </td>
                                                                                            <td class="text-center">{{ number_format($totalNominal, 2) }}</td>
                                                                                        </tr>
                                                                                        @php
                                                                                            $totalPengeluaran += $totalNominal;
                                                                                        @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @if($pengeluaran->isEmpty())
                                        <p class="text-center">Tidak ada data pengeluaran.</p>
                                    @endif
                                </div>
                                <div class="text-end">
                                    <strong>Total Pengeluaran: </strong>{{ number_format($totalPengeluaran, 2) }}
                                </div>
                            </div>

                            <!-- Tab Total -->
                            <div class="tab-pane fade" id="total" role="tabpanel" aria-labelledby="total-tab">
                                <h6>Total Pemasukan dan Pengeluaran</h6>
                                <div class="row">
                                    <!-- Pemasukan Table -->
                                    <div class="col-md-6">
                                        <h6>Pemasukan</h6>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th class="text-center">Tanggal</th>
                                                        <th class="text-center">Kategori</th>
                                                        <th class="text-center">Jumlah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $totalPemasukanTab = 0;
                                                    @endphp
                                                    @foreach($pemasukan as $key => $transaction)
                                                                                                        <tr>
                                                                                                            <td>{{ $key + 1 }}</td>
                                                                                                            <td class="text-center">
                                                                                                                {{ \Carbon\Carbon::parse($transaction->tanggal)->format('d-m-Y') }}
                                                                                                            </td>
                                                                                                            <td class="text-center">
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
                                                                                                        @php
                                                                                                            $totalPemasukanTab += $totalNominal;
                                                                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Pengeluaran Table -->
                                    <div class="col-md-6">
                                        <h6>Pengeluaran</h6>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th class="text-center">Tanggal</th>
                                                        <th class="text-center">Kategori</th>
                                                        <th class="text-center">Jumlah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $totalPengeluaranTab = 0;
                                                    @endphp
                                                    @foreach($pengeluaran as $key => $transaction)
                                                                                                        <tr>
                                                                                                            <td>{{ $key + 1 }}</td>
                                                                                                            <td class="text-center">
                                                                                                                {{ \Carbon\Carbon::parse($transaction->tanggal)->format('d-m-Y') }}
                                                                                                            </td>
                                                                                                            <td class="text-center">
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
                                                                                                        @php
                                                                                                            $totalPengeluaranTab += $totalNominal;
                                                                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <form method="GET" action="{{ route('laporankeuangan.download') }}">
                                    <input type="hidden" name="bulan" value="{{ request('bulan') }}">
                                    <input type="hidden" name="tahun" value="{{ request('tahun') }}">
                                    <button type="submit" class="btn btn-danger">Download Laporan PDF</button>
                                </form>


                                <!-- Total Pemasukan dan Pengeluaran -->
                                <div class="text-end">
                                    <strong>Total Pemasukan: </strong>{{ number_format($totalPemasukanTab, 2) }}
                                    <br>
                                    <strong>Total Pengeluaran: </strong>{{ number_format($totalPengeluaranTab, 2) }}
                                    <br>
                                    <strong>Sisa Uang:
                                    </strong>{{ number_format($totalPemasukanTab - $totalPengeluaranTab, 2) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
