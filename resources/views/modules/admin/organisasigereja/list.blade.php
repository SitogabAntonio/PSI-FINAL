@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h6>List BPH</h6>
            <a href="{{ url('/organisasigerejaadd') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Tambah BPH
            </a>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-4">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">No</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Jabatan</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Nama</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Foto</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bphList as $index => $bph)
                        <tr>
                            <td class="text-center">
                                <span class="text-xs font-weight-bold">{{ $index + 1 }}</span>
                            </td>
                            <td class="text-center">
                                <span class="text-xs font-weight-bold">{{ $bph->jabatan }}</span>
                            </td>
                            <td class="text-center">
                                <span class="text-xs font-weight-bold">{{ $bph->nama }}</span>
                            </td>
                            <td class="text-center">
                                @if($bph->foto)
                                <img src="data:image/jpeg;base64,{{ $bph->foto }}" alt="Foto {{ $bph->nama }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                <span class="text-secondary text-xs">Tidak Ada Foto</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <!-- Edit Button -->
                                <a href="{{ url('/organisasigereja/edit', $bph->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ url('/organisasigereja/delete', $bph->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus BPH ini?')">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                <span class="text-xs text-secondary">Belum ada data BPH yang ditambahkan.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
