@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white">
            <strong>Super Admin berhak menghapus Event</strong>
        </span>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">

                        <h5 class="mb-0">Semua Event</h5>

                        <form action="/event" class="d-flex align-items-center">
                            <div class="input-group mb-0">
                                <input type="text" class="form-control" placeholder="Cari Event..." name="search"
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
                        <a href="/event/create" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; Tambah
                            Event</a>
                    </div>

                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Event</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Event</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($event as $key => $item)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $event->firstItem() + $key }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$item->event_name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ \Carbon\Carbon::parse($item->event_start_date)->setTimezone('Asia/Jakarta')->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <a href="" class="badge bg-info" data-toggle="modal" data-target="#edit-{{ $item->id }}">Lihat</a>
                                        <a href="#" class="badge bg-warning" data-toggle="modal" data-target="#editModal-{{ $item->id }}">Ubah</a>
                                        <a href="{{ url('/event/delete', $item->id) }}" class="badge bg-secondary border-0 deleteKategory">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @if($event->isEmpty())
                        <div style="margin-top: 50px;">
                            <p class="text-center mb-3">Tidak ada data Event.</p>
                        </div>
                        @endif

                        <!-- Pagination -->
                        <div class="d-flex justify-content-end mt-3">
                            {{ $event->links() }}
                        </div>
                    </div>



                    @foreach($event as $key => $item)
                    <!-- Update Modal -->
                    <div id="editModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Event</h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ url('/event/update', $item->id) }}" method="POST"
                                    enctype="multipart/form-data"> @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="event_name">Nama Event</label>
                                            <input type="text" class="form-control" name="event_name"
                                                value="{{ $item->event_name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="event_description">Deskripsi Event</label>
                                            <input type="text" class="form-control" name="event_description"
                                                value="{{ $item->event_description }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="event_location">Lokasi Event</label>
                                            <textarea class="form-control" name="event_location" rows="3"
                                                required>{{ $item->event_location }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="event_start_date">Tanggal Mulai Event</label>
                                            <input type="date" class="form-control" name="event_start_date"
                                                required value="{{ $item->event_start_date }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_end_date">Tanggal Akhir Event</label>
                                            <input type="date" class="form-control" name="event_end_date"
                                                required value="{{ $item->event_end_date }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_image">Gambar Event / Brosur</label>
                                            <input type="file" class="form-control" name="event_image"
                                                accept="image/*"
                                                onchange="previewImage(event, '{{ $item->id }}')">
                                        </div>

                                        <div class="form-group">
                                            <label for="image">Gambar Event saat ini</label>
                                            <br>
                                            <img id="current-image-{{ $item->id }}"
                                                src="{{ 'data:image/jpeg;base64,' . $item->event_image }}"
                                                class="img-fluid img-thumbnail" alt="Current Image"
                                                style="max-width: 200px; max-height: 150px; margin-bottom: 10px;">
                                        </div>


                                        <div class="form-group">
                                            <label for="image">Preview Gambar Upload</label>
                                            <br>
                                            <img id="preview-{{ $item->id }}" src=""
                                                class="img-fluid img-thumbnail" alt=""
                                                style="max-width: 200px; max-height: 150px; margin-bottom: 10px;">
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


                    @foreach ($event as $data)
                    <div id="edit-{{ $data->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <strong style="font-size: 30px;">Detail Event</strong>
                                </div>
                                <div class="card border-success">
                                    <div class="card-header bg-info text-white" style="font-size: 23px;">
                                    <img src="../assets/img/logo1.png" alt="..."
                                    style="width: 70px; height: auto; margin-right: 10px;">
                                        Event "{{ $data->event_name }}"</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="table-responsive">
                                                    <table class="table cart">

                                                        <tr class="cart_item">
                                                            <th><strong>Nama Event :</strong></th>
                                                            <td>{{ $data->event_name }}</td>
                                                        </tr>
                                                        <tr class="cart_item">
                                                            <th><strong>Deskripsi Event</strong></th>
                                                            <td style="word-wrap: break-word; white-space: normal;">
                                                                {{ $data->event_description }}
                                                            </td>
                                                        </tr>
                                                        <tr class="cart_item">
                                                            <th><strong>Lokasi Event :</strong></th>
                                                            <td>{{ $data->event_location }}</td>
                                                        </tr>
                                                        <tr class="cart_item">
                                                            <th><strong>Tanggal Mulai Event :</strong></th>
                                                            <td> {{ \Carbon\Carbon::parse($data->event_start_date)->setTimezone('Asia/Jakarta')->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
                                                            </td>
                                                        </tr>
                                                        <tr class="cart_item">
                                                            <th><strong>Tanggal Berakhir Event :</strong></th>
                                                            <td> {{ \Carbon\Carbon::parse($data->event_end_date)->setTimezone('Asia/Jakarta')->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
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
                                            <div class="col-4">
                                                <div class="form-group">

                                                    <img id="current-image-{{ $data->id }}"
                                                        src="{{ 'data:image/jpeg;base64,' . $data->event_image }}"
                                                        class="img-fluid img-thumbnail" alt="Current Image"
                                                        style="max-width: 100%; margin-bottom: 10px;">
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
<script>
    function previewImage(event, itemId) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            const previewElement = document.getElementById(`preview-${itemId}`);
            previewElement.src = e.target.result;
            previewElement.style.display = 'block';
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection