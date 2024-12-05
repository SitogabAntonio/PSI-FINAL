@extends('layouts.user_type.auth')

@section('content')
<div class="container">
    <h2>Tambah Event</h2>

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

    <form action="{{ url('/event/create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="event_name">Nama Event</label>
            <input type="text" class="form-control" name="event_name" required>
        </div>
        <div class="form-group">
            <label for="event_description">Deskripsi Event</label>
            <textarea class="form-control" name="event_description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="event_location">Lokasi Event</label>
            <input type="text" class="form-control" name="event_location" required>
        </div>
        <div class="form-group">
            <label for="event_start_date">Tanggal Mulai Event</label>
            <input type="date" class="form-control" name="event_start_date" required>
        </div>
        <div class="form-group">
            <label for="event_end_date">Tanggal Akhir Event</label>
            <input type="date" class="form-control" name="event_end_date" required>
        </div>
        <div class="form-group">
            <label for="event_image">Gambar Event</label>
            <input type="file" class="form-control" name="event_image" accept="image/*" required
                onchange="previewImage(event)">
        </div>
        <div class="form-group">
            <label for="image">Preview Gambar Upload</label>
            <img id="preview" src="" class="img-fluid img-thumbnail" alt="Preview"
                style="max-width: 100%; display: none;">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Event</button>
    </form>
</div>
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            preview.style.display = 'none';
        }
    }
</script>
@endsection