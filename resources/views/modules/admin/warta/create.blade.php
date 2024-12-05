@extends('layouts.user_type.auth')

@section('content')

<div class="container-fluid">
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Tambah Warta Jemaat</h5>
        </div>
        <div class="card-body">
            <form action="{{ url('/wartajemaat/create') }}" method="POST" enctype="multipart/form-data" id="main-form">
                @csrf
                <div class="form-group">
                    <label for="judul">Nama Minggu</label>
                    <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan Nama Minggu" required>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                </div>
                <div class="form-group">
                    <label for="penkotbah">Penkotbah</label>
                    <input type="text" class="form-control" id="penkotbah" name="penkotbah" placeholder="Masukkan Nama Penkotbah" required>
                </div>
                <div class="form-group">
                    <label for="judul_renungan">Judul Renungan</label>
                    <input type="text" class="form-control" id="judul_renungan" name="judul_renungan" placeholder="Masukkan Judul Renungan" required>
                </div>
                <div class="form-group">
                    <div class="@error('deskripsi_pengumuman') border border-danger rounded-3 @enderror">
                    <label for="pengumuman">Pengumuman</label>
                        <textarea class="form-control" type="text" rows="10" placeholder="Isi Pengumuman..." id="pengumuman"
                            name="deskripsi_pengumuman"></textarea>
                        @error('deskripsi_pengumuman')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                {{-- <div class="form-group">
                    <div class="@error('deskripsi_pengumuman') border border-danger rounded-3 @enderror">
                    <label for="pengumuman">Deskripsi Pengumuman</label>
                        <textarea class="form-control" type="text" rows="5" placeholder="Deskripsi Pengumuman..." id="deskripsi_pengumuman"
                            name="deskripsi_pengumuman"></textarea>
                        @error('deskripsi_pengumuman')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div> --}}
                <div class="form-group">
                    <div class="@error('isi_renungan') border border-danger rounded-3 @enderror">
                    <label for="judul_renungan">Isi Renungan</label>
                        <textarea class="form-control" type="text" rows="10" placeholder="Isi Renungan..." id="isi_renungan"
                            name="isi_renungan"></textarea>
                        @error('isi_renungan')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div id="dynamic-inputs"></div>
                <button type="button" class="btn btn-secondary" id="add-button">
                    <i class="fas fa-plus"></i> Detail Warta
                </button>

                <div class="mt-3 text-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ url('/wartajemaat') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

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
<script>
    tinymce.init({
        selector: 'textarea#pengumuman',
        plugins: 'code table ',
        toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | ' +
        'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
        'forecolor backcolor emoticons | help'
    });
</script>

  <script>
    tinymce.init({
      selector: 'textarea#isi_renungan',
      plugins: 'code table ',
      toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | ' +
        'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
        'forecolor backcolor emoticons | help'
    });
  </script>

@endsection
