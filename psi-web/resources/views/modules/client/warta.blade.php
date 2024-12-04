@extends('layoutclient.main')
@section('content')

<div>
    <div class="page-title dark-background" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Warta Jemaat {{$gereja->name}}</h1>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('main', ['domain' => $gereja->domain]) }}">Beranda</a></li>
                    <li class="current">Warta Jemaat</li>
                </ol>
            </div>
        </nav>
    </div>

    <section id="service-details" class="service-details section">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-box">
                        <h4>List Warta Jemaat</h4>

                        <div class="table-responsive animate_animated animate_fadeInUp">
        <table class="table table-success table-striped">
            <thead>
                <tr>
                    <th scope="col">Minggu</th>
                    <th scope="col">Tanggal Warta</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wartas as $item)
                    <tr>
                        <td>{{ $item->judul }}</td>
                        <td>{{ \Carbon\Carbon::parse(time: $item->created_at)->locale(locale: 'id')->isoFormat('dddd, YYYY-MM-DD') }}
                        </td>

                        <td>
                            <a href="" class="badge bg-info" data-toggle="modal"
                                data-target="#editwarta-{{ $item->id }}">Lihat</a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($gereja->wartaJemaats->isEmpty())
            <div style="margin-top: 50px;">
                <p class="text-center mb-3">Tidak ada Warta Jemaat</p>
            </div>
        @endif

        <div class="d-flex justify-content-end">
            {{ $wartas->links() }}
        </div>
    </div>

    @foreach ($gereja->wartaJemaats as $data)
        <div id="editwarta-{{ $data->id }}" class="modal fade" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Warta Jemaat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card border-success">
                        <div class="card-header bg-info text-white" style="font-size: 23px;">
                            <strong><i class="fa fa-database"></i> Nama Minggu "{{ $data->judul }}" -
                                {{ \Carbon\Carbon::parse(time: $data->tanggal)->locale(locale: 'id')->isoFormat('dddd, YYYY-MM-DD') }}</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table cart">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    @foreach($item->detailWartas as $detail)
                                                        <tr>
                                                            <td><strong>{{ $detail->header }}</strong></td>
                                                            <td style="word-wrap: break-word; white-space: normal;">
                                                                {{ $detail->isi }}</td>
                                                        </tr>
                                                    @endforeach
                                                    <tr class="cart_item">
                                                        <th><strong>Ditambahkan pada:</strong></th>
                                                        <td>{{ \Carbon\Carbon::parse(time: $data->created_at)->locale(locale: 'id')->isoFormat('dddd, YYYY-MM-DD') }}
                                                        </td>

                                                    </tr>
                                                    <tr class="cart_item">
                                                        <th><strong>Diubah pada:</strong></th>
                                                        <td>{{ \Carbon\Carbon::parse(time: $data->created_at)->locale(locale: 'id')->isoFormat('dddd, YYYY-MM-DD') }}
                                                        </td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="footer position-relative">
                            <button class="btn btn-danger float-right my-3 mx-3" data-dismiss="modal">Tutup</button>
                            <a href="{{ route('download.pdf', $data->id) }}" class="btn btn-primary position-absolute"
                                style="bottom: 10px; right: 10px;">
                                Download PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
