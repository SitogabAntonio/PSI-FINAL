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
            <h5 class="card-title">Tambah Transaksi Keuangan</h5>
        </div>
        <div class="card-body">
            <form action="{{ url('/keuangan/create') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select class="form-control" id="kategori" name="kategori" required>
                        <option value="pemasukan">Pemasukan</option>
                        <option value="pengeluaran">Pengeluaran</option>
                    </select>
                </div>

                <hr>

                <div id="dynamic-inputs"></div>
                <button type="button" class="btn btn-secondary" id="add-button">
                    <i class="fas fa-plus"></i> Tambah Detail
                </button>

                <div class="mt-3 text-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ url('/keuangan') }}" class="btn btn-secondary">Kembali</a>
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

        const headerLabel = document.createElement('label');
        headerLabel.innerText = 'Judul:';
        headerLabel.classList.add('form-label');

        const headerInput = document.createElement('input');
        headerInput.type = 'text';
        headerInput.className = 'form-control mt-1';
        headerInput.name = 'header[]';
        headerInput.placeholder = 'Masukkan judul';
        headerInput.required = true;

        const nominalLabel = document.createElement('label');
        nominalLabel.innerText = 'Nominal:';
        nominalLabel.classList.add('form-label', 'mt-3');

        const contentNominal = document.createElement('input');
        contentNominal.type = 'number'; // Mengubah tipe input menjadi number
        contentNominal.className = 'form-control mt-1';
        contentNominal.name = 'nominal[]';
        contentNominal.placeholder = 'Masukkan nominal';
        contentNominal.required = true;

        // Hidden input to store the raw value of the nominal input
        const rawNominalInput = document.createElement('input');
        rawNominalInput.type = 'hidden';
        rawNominalInput.name = 'raw_nominal[]'; // This will be used for validation
        rawNominalInput.id = 'raw-' + Math.random().toString(36).substring(7); // Unique ID

        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.className = 'btn btn-danger btn-sm mt-2';
        removeButton.innerHTML = 'Hapus';
        removeButton.onclick = function() {
            dynamicInputs.removeChild(newInputGroup);
        };

        newInputGroup.appendChild(headerLabel);
        newInputGroup.appendChild(headerInput);
        newInputGroup.appendChild(nominalLabel);
        newInputGroup.appendChild(contentNominal);
        newInputGroup.appendChild(rawNominalInput);
        newInputGroup.appendChild(removeButton);
        dynamicInputs.appendChild(newInputGroup);
    });

    document.querySelector('form').addEventListener('submit', function(event) {
        document.querySelectorAll('.format-rp').forEach(input => {
            const rawValue = input.value.replace(/[^\d]/g, ''); // Remove formatting
            const rawInput = document.getElementById('raw-' + input.name);
            rawInput.value = rawValue; // Ensure raw value is submitted for validation
        });
    });
</script>

@endsection