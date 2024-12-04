@extends('layoutclient.main')
@section('content')

<div>
    <div class="page-title dark-background" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Suka Duka Cita {{$gereja->name}}</h1>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('main', ['domain' => $gereja->domain]) }}">Beranda</a></li>
                    <li class="current">Suka Duka Cita</li>
                </ol>
            </div>
        </nav>
    </div>

    <section id="service-details" class="service-details section">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-box">
                        <h4>List Suka Duka Cita</h4>


                        <div class="table-responsive animate_animated animate_fadeInUp">
                            <table class="table table-success table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Berita</th>
                                        <th scope="col">Tanggal Berita</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sukadukas as $item)
                                    <tr>
                                        <td>{{ $item->judul }}</td>
                                        <td>{{ \Carbon\Carbon::parse(time: $item->created_at)->locale(locale: 'id')->isoFormat('dddd, YYYY-MM-DD') }}
                                        </td>

                                        <td>
                                            <a href="" class="badge bg-info" data-toggle="modal"
                                                data-target="#editsukaduka-{{ $item->id }}">Lihat</a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if($gereja->sukadukacitas->isEmpty())
                            <div style="margin-top: 50px;">
                                <p class="text-center mb-3">Tidak ada berita Suka Duka Cita</p>
                            </div>
                            @endif

                            <div class="d-flex justify-content-end">
                                {{ $sukadukas->links() }}
                            </div>
                        </div>

                        @foreach ($gereja->sukadukacitas as $data)
                        <div id="editsukaduka-{{ $data->id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <strong style="font-size: 30px;">Detail Berita {{ $data->category}}</strong>
                                    </div>
                                    <div class="card border-success">
                                        <div class="card-header bg-info text-white" style="font-size: 23px;">
                                            <img src="../assets/img/logo1.png" alt="..."
                                                style="width: 70px; height: auto; margin-right: 10px;">
                                            <strong> Berita {{ $data->category}} "{{ $data->judul }}"</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table cart">

                                                            <tr>
                                                                <th><strong>Judul :</strong></th>
                                                                <td>{{ $data->judul }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th><strong>Deskripsi :</strong></th>
                                                                <td style="word-wrap: break-word; white-space: normal;">
                                                                    {{ $data->description }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th><strong>Detail Berita :</strong></th>
                                                                <td>{{ $data->detail }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th><strong>Tanggal Kejadian :</strong></th>
                                                                <td>{{ \Carbon\Carbon::parse(time: $data->tanggal)->locale(locale: 'id')->isoFormat('dddd, YYYY-MM-DD') }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th><strong>Pembuat :</strong></th>
                                                                <td>{{ $data->user->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th><strong>Kategori :</strong></th>
                                                                <td>{{ $data->category }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th><strong>Ditambahkan pada:</strong></th>
                                                                <td>{{ \Carbon\Carbon::parse(time: $data->created_at)->locale(locale: 'id')->isoFormat('dddd, YYYY-MM-DD') }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th><strong>Diubah pada:</strong></th>
                                                                <td>{{ \Carbon\Carbon::parse(time: $data->updated_at)->locale(locale: 'id')->isoFormat('dddd, YYYY-MM-DD') }}
                                                                </td>

                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="footer">
                                            <button class="btn btn-danger float-right my-3 mx-3" data-dismiss="modal">Tutup</button>
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