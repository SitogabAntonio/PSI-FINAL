@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Warta Jemaat</h5>
                    <div class="d-flex align-items-center">
                        <form action="/wartajemaat" class="d-flex align-items-center">
                            <div class="input-group mb-0">
                                <input type="text" class="form-control" placeholder="Cari Warta Jemaat..." name="search" value="{{ request('search') }}">
                                <span class="input-group-text" id="basic-addon1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg>
                                </span>
                            </div>
                        </form>
                        <a href="/wartajemaat/create" class="btn btn-primary" style="margin-top: 15px; margin-left: 10px;">Tambah Warta Jemaat</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="container">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($warta as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->judul }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('DD MMMM YYYY') }}</td>
                                    <td>
                                        <a href="#" class="badge bg-info me-2 custom-badge" data-toggle="modal" data-target="#detail-{{ $item->id }}">Lihat</a>
                                        <a href="#" class="badge bg-warning me-2 custom-badge" data-toggle="modal" data-target="#edit-{{ $item->id }}">Ubah</a>
                                        <a href="/wartajemaat/destroy/{{$item->id}}" class="badge bg-danger custom-badge" onclick="return confirm('yakin?');">Delete</a>
                                    </td>
                                </tr>
                                @endforeach

                                @if($warta->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data Warta Jemaat.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end mt-3">
                            {{ $warta->links() }}
                        </div>
                    </div>
                </div>


                <!-- Modal for each warta -->
                @foreach ($warta as $data)
                <div id="detail-{{ $data->id }}" class="modal fade" role="dialog">
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
                                    <strong><i class="fa fa-database"></i> {{ $data->judul }}, {{ \Carbon\Carbon::parse($data->tanggal)->isoFormat('DD MMMM YYYY') }}</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <h6>Detail Warta:</h6>
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        @foreach($data->detailWartas as $detail)
                                                        <tr>
                                                            <td><strong>{{ $detail->header }}</strong></td>
                                                            <td>{{ $detail->isi }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <button class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                    <a href="{{ route('wartajemaat.download-pdf', $data->id) }}" class="btn btn-secondary" target="_blank">Download</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach


                @foreach ($warta as $data)
                <div id="edit-{{ $data->id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Warta Jemaat</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ url('/wartajemaat/update', $data->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="judul">Judul</label>
                                        <input type="text" class="form-control" id="judul" name="judul" value="{{ $data->judul }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $data->tanggal }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="penkotbah">Penkotbah</label>
                                        <input type="text" class="form-control" id="penkotbah" name="penkotbah" value="{{ $data->penkotbah }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="judul_renungan">Judul Renungan</label>
                                        <input type="text" class="form-control" id="judul_renungan" name="judul_renungan" value="{{ $data->judul_renungan }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="isi_renungan">Isi Renungan</label>
                                        <textarea class="form-control" id="isi_renungan" name="isi_renungan" rows="4" required>{{ $data->isi_renungan }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="deskripsi_pengumuman">Deskripsi Pengumuman</label>
                                        <textarea class="form-control" id="deskripsi_pengumuman" name="deskripsi_pengumuman" rows="4" required>{{ $data->deskripsi_pengumuman }}</textarea>
                                    </div>

                                    <h6>Edit Detail Warta:</h6>
                                    @foreach($data->detailWartas as $detail)
                                    <div class="form-group detail-item" id="detail-{{ $detail->id }}">
                                        <label for="header-{{ $detail->id }}">Header</label>
                                        <input type="text" class="form-control" id="header-{{ $detail->id }}" name="header[{{ $detail->id }}]" value="{{ $detail->header }}" required>
                                        <label for="isi-{{ $detail->id }}">Isi</label>
                                        <textarea class="form-control" id="isi-{{ $detail->id }}" name="isi[{{ $detail->id }}]" required>{{ $detail->isi }}</textarea>
                                        <button type="button" class="btn btn-danger mt-2 delete-detail" data-id="{{ $detail->id }}">Hapus</button>
                                    </div>
                                    @endforeach
                                    <div id="dynamic-inputs"></div>

                                    <button type="button" class="btn btn-secondary" id="add-button">
                                        <i class="fas fa-plus"></i> Detail Warta
                                    </button>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach

                <style>
                    .table td {
                        max-width: 300px;
                        word-wrap: break-word;
                        white-space: normal;
                    }
                </style>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        function attachDeleteListeners() {
                            document.querySelectorAll('.delete-detail').forEach(function(button) {
                                button.addEventListener('click', function() {
                                    let detailId = this.getAttribute('data-id');

                                    if (confirm("Yakin ingin menghapus detail ini?")) {
                                        fetch(/detailwarta/delete/${detailId}, {
                                                method: 'DELETE',
                                                headers: {
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                }
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                if (data.success) {
                                                    document.getElementById(detail-${detailId}).remove();
                                                    alert("Detail berhasil dihapus");
                                                } else {
                                                    alert("Gagal menghapus detail");
                                                }
                                            })
                                            .catch(error => {
                                                console.error("Error deleting detail:", error);
                                                alert("Terjadi kesalahan saat menghapus detail");
                                            });
                                    }
                                });
                            });
                        }
                        attachDeleteListeners();
                    });
                </script>

                <script>
                    document.getElementById('add-button').addEventListener('click', function() {
                        const dynamicInputs = document.getElementById('dynamic-inputs');

                        const newInputGroup = document.createElement('div');
                        newInputGroup.classList.add('mb-3');

                        const headerInput = document.createElement('input');
                        headerInput.type = 'text';
                        headerInput.className = 'form-control mb-2';
                        headerInput.name = 'header[]';
                        headerInput.placeholder = 'Masukkan judul';
                        headerInput.required = true;

                        const contentTextarea = document.createElement('textarea');
                        contentTextarea.className = 'form-control mb-2';
                        contentTextarea.name = 'isi[]';
                        contentTextarea.placeholder = 'Masukkan Isi';
                        contentTextarea.required = true;
                        contentTextarea.rows = 3;

                        const removeButton = document.createElement('button');
                        removeButton.type = 'button';
                        removeButton.className = 'btn btn-danger btn-sm mt-2';
                        removeButton.innerHTML = 'Hapus';
                        removeButton.onclick = function() {
                            dynamicInputs.removeChild(newInputGroup);
                        };

                        newInputGroup.appendChild(headerInput);
                        newInputGroup.appendChild(contentTextarea);
                        newInputGroup.appendChild(removeButton);
                        dynamicInputs.appendChild(newInputGroup);
                    });
                </script>


                <!-- Include Bootstrap JS and jQuery -->
                <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

                {{ $warta->links() }}
            </div>
        </div>
    </div>

    @endsection