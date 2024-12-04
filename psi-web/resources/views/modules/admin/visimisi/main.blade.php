@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white">
            <strong>Super Admin berhak menghapus Misi Gereja</strong>
        </span>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <h5 class="mb-0">Semua Misi Gereja</h5>
                        <form action="/visi-misi" class="d-flex align-items-center">
                            <div class="input-group mb-0">
                                <input type="text" class="form-control" placeholder="Cari Misi Gereja..." name="search"
                                    value="{{ request('search') }}">
                                <span class="input-group-text" id="basic-addon1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg>
                                </span>
                            </div>
                        </form>
                        <a href="/visi-misi/createmisi" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp;
                            Tambah Misi Gereja</a>
                    </div>

                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        No
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Misi
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal ditambahkan
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($misi as $key => $item)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $misi->firstItem() + $key }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {!! strlen($item->title_misi) > 40 ? substr($item->title_misi, 0, 40) . '...' : $item->title_misi !!}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ \Carbon\Carbon::parse($item->created_at)->setTimezone('Asia/Jakarta')->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <a href="" class="badge bg-info" data-toggle="modal" data-target="#edit-{{ $item->id }}">Lihat</a>
                                        <a href="#" class="badge bg-warning" data-toggle="modal" data-target="#editModal-{{ $item->id }}">Ubah</a>
                                        <a href="{{ url('/visi-misi/detelemisi', $item->id) }}" class="badge bg-secondary border-0 deleteKategory">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end mt-4">
                            {{ $misi->appends(['search' => request('search')])->links() }}
                        </div>
                        @if($misi->isEmpty())
                        <div style="margin-top: 50px;">
                            <p class="text-center mb-3">Tidak ada data Misi Gereja Anda.</p>
                        </div>
                        @endif
                    </div>

                    @foreach($misi as $key => $item)
                    <!-- Update Modal -->
                    <div id="editModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Misi Gereja</h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ url('/visi-misi/updatemisi', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="title_misi">Misi</label>
                                            <textarea class="form-control" name="title_misi" rows="3"
                                                required>{!! $item->title_misi !!}</textarea>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan
                                            Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach


                    @foreach ($misi as $data)
                    <div id="edit-{{ $data->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <strong style="font-size: 30px;">Detail Misi Gereja</strong>
                                </div>
                                <div class="card border-success">
                                    <div class="card-header bg-info text-white" style="font-size: 23px;">
                                        <strong>
                                            <div style="display: flex; align-items: center;">
                                                <img src="../assets/img/logo1.png" alt="..."
                                                    style="width: 70px; height: auto; margin-right: 10px;">
                                                Misi Gereja <small>"{!! $data->title_misi!!}"</small>

                                            </div>
                                        </strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table cart">
                                                        <tr>
                                                            <th><strong>Misi</strong></th>
                                                            <td
                                                                style="word-wrap: break-word; white-space: normal;">
                                                                {{$data->title_misi}}
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th><strong>Ditambahkan pada:</strong></th>
                                                            <td>{{ \Carbon\Carbon::parse($data->created_at)->setTimezone('Asia/Jakarta')->locale('id')->isoFormat('dddd, DD MMMM YYYY, HH:mm [WIB]') }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th><strong>Diubah pada:</strong></th>
                                                            <td>{{ \Carbon\Carbon::parse($data->updated_at)->setTimezone('Asia/Jakarta')->locale('id')->isoFormat('dddd, DD MMMM YYYY, HH:mm [WIB]') }}
                                                            </td>
                                                        </tr>
                                                        <tr></tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <button class="btn btn-danger float-right my-3 mx-3"
                                            data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
                        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
                        crossorigin="anonymous">
                    </script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
                        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                        crossorigin="anonymous">
                    </script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                        crossorigin="anonymous">
                    </script>
                </div>
            </div>
        </div>
    </div>


    <!-- Visi -->

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <h5 class="mb-0">Semua Visi Gereja</h5>
                        <form action="/visi-misi" class="d-flex align-items-center">
                            <div class="input-group mb-0">
                                <input type="text" class="form-control" placeholder="Cari Visi Gereja..." name="searchvisi"
                                    value="{{ request('searchvisi') }}">
                                <span class="input-group-text" id="basic-addon1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg>
                                </span>
                            </div>
                        </form>
                        <a href="/visi-misi/createvisi" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp;
                            Tambah Visi Gereja</a>
                    </div>

                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        No
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Visi
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal ditambahkan
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($visi as $key => $item)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $visi->firstItem() + $key }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ strlen($item->title_visi) > 40 ? substr($item->title_visi, 0, 40) . '...' : $item->title_visi }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ \Carbon\Carbon::parse($item->created_at)->setTimezone('Asia/Jakarta')->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <a href="" class="badge bg-info" data-toggle="modal" data-target="#detailvisi-{{ $item->id }}">Lihat</a>
                                        <a href="#" class="badge bg-warning" data-toggle="modal" data-target="#editvisi-{{ $item->id }}">Ubah</a>
                                        <a href="{{ url('/visi-misi/detelevisi', $item->id) }}" class="badge bg-secondary border-0 deleteKategory">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-end mt-4">
                            {{ $visi->appends(['searchvisi' => request('searchvisi')])->links() }}
                        </div>


                        @if($visi->isEmpty())
                        <div style="margin-top: 50px;">
                            <p class="text-center mb-3">Tidak ada data Visi Gereja Anda.</p>
                        </div>
                        @endif
                    </div>

                    @foreach($visi as $key => $item)
                    <!-- Update Modal -->
                    <div id="editvisi-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Visi Gereja</h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ url('/visi-misi/updatevisi', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="title_visi">Visi</label>
                                            <textarea class="form-control" name="title_visi" rows="3"
                                                required>{{ $item->title_visi }}</textarea>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan
                                            Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach


                    @foreach ($visi as $data)
                    <div id="detailvisi-{{ $data->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <strong style="font-size: 30px;">Detail Visi Gereja
                                    </strong>
                                </div>
                                <div class="card border-success">
                                    <div class="card-header bg-info text-white" style="font-size: 23px;">
                                        <strong>
                                            <div style="display: flex; align-items: center;">
                                                <img src="../assets/img/logo1.png" alt="..."
                                                    style="width: 70px; height: auto; margin-right: 10px;">
                                                Visi Gereja
                                                <small>"{{ $data->title_visi}}"</small>
                                            </div>
                                        </strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table cart">
                                                        <tr>
                                                            <th><strong>Visi</strong></th>
                                                            <td
                                                                style="word-wrap: break-word; white-space: normal;">
                                                                {{$data->title_visi}}
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th><strong>Ditambahkan pada:</strong></th>
                                                            <td>{{ \Carbon\Carbon::parse($data->created_at)->setTimezone('Asia/Jakarta')->locale('id')->isoFormat('dddd, DD MMMM YYYY, HH:mm [WIB]') }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th><strong>Diubah pada:</strong></th>
                                                            <td>{{ \Carbon\Carbon::parse($data->updated_at)->setTimezone('Asia/Jakarta')->locale('id')->isoFormat('dddd, DD MMMM YYYY, HH:mm [WIB]') }}
                                                            </td>
                                                        </tr>
                                                        <tr></tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <button class="btn btn-danger float-right my-3 mx-3"
                                            data-dismiss="modal">Tutup</button>
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
</div>
@endsection