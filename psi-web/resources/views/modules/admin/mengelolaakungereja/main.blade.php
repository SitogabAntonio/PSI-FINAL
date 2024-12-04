@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white">
            <strong>Super Admin berhak menghapus akun Admin Gereja</strong>
        </span>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Semua Akun Gereja</h5>
                        <form action="/akungereja" class="d-flex align-items-center">

                            <div class="input-group mb-0">
                                <input type="text" class="form-control" placeholder="Cari Akun Gereja" name="search"
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
                        <a href="/akungereja/create" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp;
                            Tambah Akun Gereja</a>
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
                                        Nama Gereja
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status Akun
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($akungereja as $key => $item)
                                                <tr>
                                                    <td class="ps-4">
                                                        <p class="text-xs font-weight-bold mb-0">{{ $akungereja->firstItem() + $key }}
                                                        </p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="text-xs font-weight-bold mb-0">{{$item->name}}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="text-xs font-weight-bold mb-0">{{$item->name}}</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            @if($item->status === 'ACTIVE')
                                                                <button class="badge bg-success border-0"
                                                                    disabled>{{ $item->status }}</button>
                                                            @elseif($item->status === 'BLOCKED')
                                                                <span class="badge bg-danger border-0">{{ $item->status }}</span>
                                                            @else
                                                                <button class="badge bg-secondary border-0 delete-button"
                                                                    data-id="{{ $item->id }}">{{ $item->status }}</button>
                                                            @endif
                                                        </p>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="" class="badge bg-info" data-toggle="modal"
                                                            data-target="#edit-{{ $item->id }}">Lihat</a>
                                                        <a href="#" class="badge bg-warning" data-toggle="modal"
                                                            data-target="#editModal-{{ $item->id }}">Ubah Status Akun</a>
                                                            <button class="badge bg-secondary border-0 reset-password-button" data-id="{{ $item->id }}">Reset Password</button>


                                                        <button class="badge bg-secondary border-0 delete-button"
                                                            data-id="{{ $item->id }}">Hapus</button>
                                                    </td>
                                                </tr>

                                                <div id="editModal-{{ $item->id }}" class="modal fade" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Status Akun Gereja</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ url('/akungereja/status', $item->id) }}" method="POST"">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class=" modal-body">
                                                                <input type="hidden" name="user_id" id="user_id" value="">
                                                                <div class="form-group">
                                                                    <label for="status">Pilih Status</label>
                                                                    <select class="form-control" id="status" name="status">
                                                                        <option value="ACTIVE" {{ $item->status === 'ACTIVE' ? 'selected' : '' }}>ACTIVE</option>
                                                                        <option value="BLOCKED" {{ $item->status === 'BLOCKED' ? 'selected' : '' }}>BLOCKED</option>
                                                                    </select>
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
                    </tbody>

                    </table>
                    <br>
                    {{ $pagination->links() }}




                    @if($akungereja->isEmpty())
                        <div style="margin-top: 50px;">
                            <p class="text-center mb-3">Tidak ada data Akun Gereja.</p>
                        </div>
                    @endif
                </div>
                @foreach ($akungereja as $data)
                    <div id="edit-{{ $data->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <strong style="font-size: 30px;">Detail Akun Gereja</strong>
                                </div>
                                <div class="card border-success">
                                    <div class="card-header bg-info text-white" style="font-size: 23px;">
                                        <strong><i class="fa fa-database"></i> Akun Gereja "{{ $data->name }}"</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="table-responsive">
                                                    <table class="table cart">

                                                        <tr>
                                                            <th><strong>Nama Gereja :</strong></th>
                                                            <td>{{ $data->name ?? '-' }}</td>
                                                        </tr>
                                                        <tr class="">
                                                            <th><strong>Email Gereja :</strong></th>
                                                            <td>{{ $data->email ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th><strong>Domain Url :</strong></th>
                                                            <td>{{ $data->domain ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th><strong>Google Map :</strong></th>
                                                            <td>{{ $data->google_map ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th><strong>Nomor Telepon :</strong></th>
                                                            <td>{{ $data->phone ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th><strong>Alamat :</strong></th>
                                                            <td>{{ $data->location ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th><strong>Tentang :</strong></th>
                                                            <td>{{ $data->about_me ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th><strong>Ditambahkan pada:</strong></th>
                                                            <td>{{ $data->created_at ?? '-' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th><strong>Diubah pada:</strong></th>
                                                            <td>{{ $data->updated_at ?? '-' }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                @if (!empty($data->image))
                                                    <img id="current-image-{{ $item->id }}"
                                                        src="{{ 'data:image/jpeg;base64,' . $data->image }}"
                                                        class="img-fluid img-thumbnail" alt="Current Image"
                                                        style="max-width: 100%; margin-bottom: 10px;">
                                                @else
                                                    <p class="no-image-text">Gambar tidak ada 😞</p>
                                                @endif
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
                <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog"
                    aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteConfirmModalLabel">Konfirmasi Hapus</h5>
                              
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus Gereja ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <a href="#" id="confirmDeleteButton" class="btn btn-danger">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="resetPasswordConfirmModal" tabindex="-1" role="dialog" aria-labelledby="resetPasswordConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetPasswordConfirmModalLabel">Konfirmasi Reset Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin mereset password akun ini menjadi 123?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <form id="resetPasswordForm" action="#" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const resetPasswordButtons = document.querySelectorAll('.reset-password-button');

        resetPasswordButtons.forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.getAttribute('data-id');
                const resetUrl = `/reset-password/${userId}`;
                document.getElementById('resetPasswordForm').setAttribute('action', resetUrl);
                $('#resetPasswordConfirmModal').modal('show');
            });
        });
    });

    
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const closeModalButtons = document.querySelectorAll('.close, .btn-secondary');

        closeModalButtons.forEach(button => {
            button.addEventListener('click', function () {
                $('#resetPasswordConfirmModal').modal('hide');
            });
        });
    });
</script>



                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const deleteButtons = document.querySelectorAll('.delete-button');

                        deleteButtons.forEach(button => {
                            button.addEventListener('click', function () {
                                const itemId = this.getAttribute('data-id');
                                confirmDelete(itemId);
                            });
                        });
                    });

                    function confirmDelete(id) {
                        const deleteUrl = `/akungereja/detele/${id}`;
                        document.getElementById('confirmDeleteButton').setAttribute('href', deleteUrl);
                        $('#deleteConfirmModal').modal('show');
                    }
                </script>
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
                <script>
                    $('.btn-secondary').on('click', function () {
                        $('#deleteConfirmModal').modal('hide');
                    });
                </script>
            </div>
        </div>
    </div>
</div>
</div>

<style>
    .no-image-text {
        font-size: 1.2em;
        color: #ff5c5c;
        text-align: center;
        padding: 20px;
        border: 2px dashed #ff5c5c;
        border-radius: 10px;
        animation: blink 1s infinite;
        max-width: 100%;
        margin: auto;
    }

    @keyframes blink {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    @media (max-width: 768px) {
        .no-image-text {
            font-size: 1em;
            padding: 15px;
        }
    }
</style>

@endsection