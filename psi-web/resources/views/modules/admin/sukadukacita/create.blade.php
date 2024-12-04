@extends('layouts.user_type.auth')

@section('content')
<div class="container">
    <h2>Tambah Berita Suka / Duka Cita</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ url('/sukadukacita/create') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" name="judul" required>
            </div>
            <div class="form-group">
                <label for="description">Dekripsi</label>
                <input type="text" class="form-control" name="description" required>
            </div>
            <div class="form-group">
                <label for="detail">Detail</label>
                <textarea class="form-control" name="detail" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" class="form-control" name="tanggal" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" name="category" required>
                    <option value="">Pilih Kategori</option>
                    <option value="SUKA CITA">SUKA CITA</option>
                    <option value="DUKA CITA">DUKA CITA</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Berita</button>
    </form>
</div>
@endsection