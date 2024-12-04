@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <!-- Small Upload Button above the search bar -->
        <div class="d-flex justify-content-end mb-4">
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadModal"
                style="margin-top:20px; margin-right: 20px;">Upload Excel</button>
        </div>

        <div class="card-body px-0 pt-0 pb-2">
            <!-- Search Form -->
            <div class="d-flex justify-content-end mb-4">
                <form action="#" method="GET" class="d-flex">
                    <input type="text" name="search" value="{{ request()->get('search') }}"
                        class="form-control form-control-sm" style="height: 35px; width:355px;"
                        placeholder="Cari nama / no KK" />
                    <button class="btn btn-outline-primary btn-sm ms-2" type="submit"
                        style="height: 35px; margin-right:15px;">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>

            <div class="table-responsive p-4">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">No</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Keluarga</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">No.KK</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Nama</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
    @forelse($anggotaGereja as $key => $anggota)
    <tr>
        <td class="text-center">{{ $anggotaGereja->firstItem() + $key }}</td>
        <!-- Nomor urut yang benar -->
        <td class="text-center">{{ $anggota->keluarga }}</td>
        <td class="text-center">{{ $anggota->no_kk }}</td>
        <td class="text-center">{{ $anggota->nama }}</td>
        <td class="text-center">
            <!-- Tombol Edit -->
            <button class="btn btn-warning btn-sm edit-btn" data-id="{{ $anggota->id }}"
                data-bs-toggle="modal" data-bs-target="#editModal">
                <i class="fa fa-edit"></i> Edit
            </button>
            <!-- Tombol Delete -->
            <form action="{{ route('anggota.delete', $anggota->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE') <!-- Method spoofing untuk menggunakan DELETE -->
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fa fa-trash"></i> Delete
                </button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" class="text-center">Belum ada data anggota gereja.</td>
    </tr>
    @endforelse
</tbody>

                </table>

                <!-- Pagination links -->
                <div class="d-flex justify-content-end mt-4">
                    {{ $anggotaGereja->links() }}
                </div>
            </div>
        </div>

        <!-- Modal Edit Anggota -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Anggota</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" method="POST" action="{{ route('anggota.update', 'anggota_id') }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="keluarga" class="form-label">Keluarga</label>
                                <input type="text" class="form-control" id="keluarga" name="keluarga">
                            </div>
                            <div class="mb-3">
                                <label for="no_kk" class="form-label">No. KK</label>
                                <input type="text" class="form-control" id="no_kk" name="no_kk">
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Upload Excel -->
        <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadModalLabel">Upload Excel File</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('anggota.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">Pilih File Excel</label>
                                <input type="file" name="file" class="form-control" accept=".xlsx,.csv,.ods" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    // Ketika tombol edit diklik
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            const anggotaId = this.getAttribute('data-id');

            // Kirim request untuk mengambil data anggota berdasarkan ID
            fetch(`/anggota/edit/${anggotaId}`)
                .then(response => response.json())
                .then(data => {
                    // Isi form dengan data yang diambil
                    document.getElementById('keluarga').value = data.keluarga;  // Menampilkan keluarga yang ada
                    document.getElementById('no_kk').value = data.no_kk;  // Menampilkan no KK yang ada
                    document.getElementById('nama').value = data.nama;  // Menampilkan nama yang ada

                    // Update action URL form untuk update
                    const formAction = document.getElementById('editForm').getAttribute('action').replace('anggota_id', data.id);
                    document.getElementById('editForm').setAttribute('action', formAction);
                })
                .catch(error => console.log('Error fetching data: ', error));
        });
    });
</script>

@endsection
