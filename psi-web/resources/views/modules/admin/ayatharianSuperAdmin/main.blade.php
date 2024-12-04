@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white">
            <strong>Super Admin berhak menghapus Ayat Harian</strong>
        </span>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">

                        <h5 class="mb-0">Semua Ayat Harian</h5>

                        <form action="/ayatharian/superadmin" class="d-flex align-items-center">
                            <div class="input-group mb-0">
                                <input type="text" class="form-control" placeholder="Cari Tema Ayat Harian..."
                                    name="search" value="{{ request('search') }}">
                                <span class="input-group-text" id="basic-addon1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive p-0">

                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        No
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tema
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Pembuat
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal Ayat Harian
                                    </th>

                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ayathariansuperadmin as $key => $item)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $ayathariansuperadmin->firstItem() + $key }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">
                                        {{ strlen($item->tema) > 40 ? substr($item->tema, 0, 40) . '...' : $item->tema }}
                                    </p>                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$item->user->name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->setTimezone('Asia/Jakarta')->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <a href="" class="badge bg-info" data-toggle="modal"
                                            data-target="#edit-{{ $item->id }}">Lihat</a>
                                        <a href="{{ url('/ayatharian/superadmin/detele', $item->id) }}"
                                            class="badge bg-secondary  border-0 deleteKategory">Hapus</a> </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($ayathariansuperadmin->isEmpty())
                        <div style="margin-top: 50px;">
                            <p class="text-center mb-3">Tidak ada data Ayat Harian.</p>
                        </div>

                        @endif
                    </div>

                    <br>
                    {{ $pagination->links() }}

                    @foreach ($ayathariansuperadmin as $data)
                    <div id="edit-{{ $data->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <strong style="font-size: 30px;">Detail Ayat Harian
                                        <small>"
                                            {{ \Carbon\Carbon::parse($data->tanggal)->setTimezone('Asia/Jakarta')->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}

                                            "</small></strong>
                                </div>
                                <div class="card border-success">
                                    <div class="card-header bg-info text-white" style="font-size: 23px;">
                                        <strong>
                                            <div style="display: flex; align-items: center;">
                                                <img src="../assets/img/logo1.png" alt="..."
                                                    style="width: 70px; height: auto; margin-right: 10px;">
                                                Ayat Harian "{{ $data->tema }}"
                                            </div>
                                        </strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table cart">

                                                        <tr class="cart_item">
                                                            <th><strong>Tema :</strong></th>
                                                            <td>{{ $data->tema }}</td>
                                                        </tr>
                                                        <tr class="cart_item">
                                                            <th><strong>Pasal - Ayat :</strong></th>
                                                            <td>{{ $data->ayat }}</td>
                                                        </tr>
                                                        <tr class="cart_item">
                                                            <th><strong>Isi Ayat :</strong></th>
                                                            <td style="word-wrap: break-word; white-space: normal;">
                                                                {{ $data->isi_ayat }}
                                                            </td>
                                                        </tr>
                                                        <tr class="cart_item">
                                                            <th><strong>Penjelasan / Renungan :</strong></th>
                                                            <td style="word-wrap: break-word; white-space: normal;">
                                                                {{ $data->detail }}
                                                            </td>
                                                        </tr>
                                                        <tr class="cart_item">
                                                            <th><strong>Pembuat :</strong></th>
                                                            <td>{{ $data->user->name }}</td>
                                                        </tr>
                                                        <tr class="cart_item">
                                                            <th><strong>Tanggal Ayat:</strong></th>
                                                            <td>
                                                                {{ \Carbon\Carbon::parse($data->tanggal)->setTimezone('Asia/Jakarta')->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
                                                            </td>
                                                        </tr>
                                                        <tr class="cart_item">
                                                            <th><strong>Ditambahkan pada:</strong></th>
                                                            <td> {{ \Carbon\Carbon::parse($data->created_at)->setTimezone('Asia/Jakarta')->locale('id')->isoFormat('dddd, DD MMMM YYYY, HH:mm [WIB]') }}
                                                            </td>
                                                        </tr>
                                                        <tr class="cart_item">
                                                            <th><strong>Diubah pada:</strong></th>
                                                            <td> {{ \Carbon\Carbon::parse($data->updated_at)->setTimezone('Asia/Jakarta')->locale('id')->isoFormat('dddd, DD MMMM YYYY, HH:mm [WIB]') }}
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
</div>
@endsection
