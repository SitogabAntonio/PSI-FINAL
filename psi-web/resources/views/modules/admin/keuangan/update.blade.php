@extends('layouts.user_type.auth')

@section('content')
<div id="loading" class="spinner-border text-primary" role="status" style="display: none;">
    <span class="visually-hidden">Loading...</span>
</div>
<div class="container-fluid">
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <div class="container">
        <h1 class="mb-4">Update Warta Jemaat</h1>
        <form action="{{ route('saveUpdate-wartajemaat', $wartajemaat->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $wartajemaat->judul) }}" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ old('deskripsi', $wartajemaat->deskripsi) }}</textarea>
            </div>
            <div class="form-group">
                <label for="acara1">Acara 1</label>
                <input type="text" class="form-control" id="acara1" name="acara1" value="{{ old('acara1', $wartajemaat->acara1) }}" required>
            </div>
            <div class="form-group">
                <label for="acara2">Acara 2</label>
                <input type="text" class="form-control" id="acara2" name="acara2" value="{{ old('acara2', $wartajemaat->acara2) }}" required>
            </div>
            <div class="form-group">
                <label for="koor">Koor</label>
                <input type="text" class="form-control" id="koor" name="koor" value="{{ old('koor', $wartajemaat->koor) }}">
            </div>
            <div class="form-group">
                <label for="evangelisasi">Evangelisasi</label>
                <input type="text" class="form-control" id="evangelisasi" name="evangelisasi" value="{{ old('evangelisasi', $wartajemaat->evangelisasi) }}">
            </div>
            <div class="form-group">
                <label for="ulang_tahun">Ulang Tahun</label>
                <input type="text" class="form-control" id="ulang_tahun" name="ulang_tahun" value="{{ old('ulang_tahun', $wartajemaat->ulang_tahun) }}">
            </div>
            <button type="submit" class="btn btn-primary">Update Warta Jemaat</button>
        </form>
    </div>
</div>
@endsection