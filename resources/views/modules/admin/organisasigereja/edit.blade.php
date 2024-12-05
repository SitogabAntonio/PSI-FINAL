@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0">
            <h6>Edit BPH</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <form action="{{ route('organisasigereja.update', $bph->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" id="jabatan" name="jabatan" class="form-control" value="{{ old('jabatan', $bph->jabatan) }}" required>
                </div>

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', $bph->nama) }}" required>
                </div>

                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" id="foto" name="foto" class="form-control">
                    @if($bph->foto)
                    <img src="data:image/jpeg;base64,{{ $bph->foto }}" alt="Foto {{ $bph->nama }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary btn-sm">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
