@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Pemasukan/Pengeluaran Gereja</h5>
                </div>

                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Pemasukan/Pengeluaran Gereja</h5>
                                        <div class="d-flex align-items-center mb-3">
                                            <form method="GET" action="{{ route('keuangan.index') }}" class="me-auto">
                                                <div class="row mb-0">
                                                    <div class="col-md-4">
                                                        <select name="kategori" class="form-control form-control-sm">
                                                            <option value="">Semua Kategori</option>
                                                            <option value="pemasukan" {{ request('kategori') == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                                                            <option value="pengeluaran" {{ request('kategori') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <a href="/keuangan/create" class="btn btn-primary ms-auto btn-sm" style="margin-top: 0;">Tambah</a>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th class="text-center">Tanggal</th>
                                                        <th class="text-center">Kategori</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($keuangan as $key => $transaction)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td class="text-center">{{ \Carbon\Carbon::parse($transaction->tanggal)->format('d-m-Y') }}</td>
                                                        <td class="text-center">{{ ucfirst($transaction->kategori) }}</td>
                                                        <td class="text-center">
                                                            <a href="#" class="badge bg-info me-2 custom-badge" data-toggle="modal" data-target="#detail-{{ $transaction->id }}">
                                                                Lihat
                                                            </a>
                                                            <a href="#" class="badge bg-warning me-2 custom-badge" data-toggle="modal" data-target="#edit-{{ $transaction->id }}">
                                                                Ubah
                                                            </a>
                                                            <a href="/keuangan/destroy/{{$transaction->id}}" class="badge bg-danger custom-badge" onclick="return confirm('Yakin ingin menghapus?');">
                                                                Hapus
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @if($keuangan->isEmpty())
                                            <p class="text-center">Tidak ada data transaksi keuangan.</p>
                                            @endif
                                        </div>
                                        <div class="pagination-container">
                                            {{ $keuangan->links() }}
                                        </div>
                                        <a href="{{ route('keuangan.download-pdf', $userId) }}" class="badge bg-info me-2 custom-badge" target="_blank" title="Download">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for each transaction -->
                @foreach ($keuangan as $data)
                <div id="detail-{{ $data->id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Transaksi Keuangan</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6>Tanggal: {{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</h6>
                                        <table class="table table-bordered">
                                            <tbody>
                                                @php
                                                // Decode JSON string into PHP array
                                                $details = json_decode($data->details, true);
                                                $total = 0;
                                                @endphp
                                                @foreach($details as $detail)
                                                <tr>
                                                    <td><strong>{{ ucfirst($detail['header']) }}</strong></td>
                                                    <td>Rp. {{ number_format($detail['nominal'], 0, ',', '.') }}</td>
                                                </tr>
                                                @php
                                                $total += $detail['nominal'];
                                                @endphp
                                                @endforeach
                                                <tr>
                                                    <td><strong>Total</strong></td>
                                                    <td>Rp. {{ number_format($total, 0, ',', '.') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                @foreach ($keuangan as $data)
                <div id="edit-{{ $data->id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Transaksi Keuangan</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('/keuangan/update/'.$data->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="tanggal">Tanggal</label>
                                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $data->tanggal }}" required>
                                            </div>

                                            @php
                                            $details = json_decode($data->details, true); // Decode JSON string to array
                                            @endphp

                                            <div id="detail-{{ $data->id }}" class="form-group">
                                                <div class="detail-item-container">
                                                    @foreach($details as $index => $detail)
                                                    <div class="detail-item" id="detail-item-{{ $index }}">
                                                        <label for="header-{{ $data->id }}-{{ $index }}">Judul</label>
                                                        <input type="text" class="form-control" id="header-{{ $data->id }}-{{ $index }}" name="header[]" value="{{ $detail['header'] }}" required>

                                                        <label for="nominal-{{ $data->id }}-{{ $index }}">Nominal</label>
                                                        <input type="text" class="form-control" id="nominal-{{ $data->id }}-{{ $index }}" name="nominal[]" value="{{ $detail['nominal'] }}" required>

                                                        <button type="button" class="btn btn-danger remove-detail mt-2" data-index="{{ $index }}">
                                                            <i class="fas fa-minus"></i> Hapus
                                                        </button>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <button type="button" class="btn btn-secondary" id="add-button">
                                                <i class="fas fa-plus"></i> Tambahan Masukan
                                            </button>

                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach



                <script>
                    document.querySelectorAll('.format-rp').forEach(input => {
                        input.addEventListener('input', function() {
                            const value = this.value.replace(/[^\d]/g, '');
                            if (value) {
                                this.value = 'Rp. ' + new Intl.NumberFormat('id-ID').format(value);
                            } else {
                                this.value = '';
                            }
                        });

                        input.addEventListener('blur', function() {
                            const rawValue = this.value.replace(/[^\d]/g, '');
                            document.getElementById('raw_' + this.id).value = rawValue;
                        });
                    });

                    document.querySelectorAll('form').forEach(form => {
                        form.addEventListener('submit', function() {
                            document.querySelectorAll('.format-rp').forEach(input => {
                                const rawValue = input.value.replace(/[^\d]/g, '');
                                document.getElementById('raw_' + input.id).value = rawValue;
                            });
                        });
                    });
                </script>

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

                        const nominalInput = document.createElement('input');
                        nominalInput.type = 'text';
                        nominalInput.className = 'form-control mt-1 format-rp';
                        nominalInput.name = 'nominal[]';
                        nominalInput.placeholder = 'Masukkan nominal';
                        nominalInput.required = true;

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
                        newInputGroup.appendChild(nominalInput);
                        newInputGroup.appendChild(removeButton);
                        dynamicInputs.appendChild(newInputGroup);

                        addRupiahFormatListeners(nominalInput);
                    });

                    function addRupiahFormatListeners(input) {
                        input.addEventListener('input', function() {
                            const value = this.value.replace(/[^\d]/g, '');
                            if (value) {
                                this.value = 'Rp. ' + new Intl.NumberFormat('id-ID').format(value);
                            } else {
                                this.value = '';
                            }
                        });
                    }
                </script>

                <script>
                    document.getElementById('add-button').addEventListener('click', function() {
                        var container = document.querySelector('.detail-item-container');
                        var index = container.children.length;

                        var newDetail = document.createElement('div');
                        newDetail.classList.add('detail-item');
                        newDetail.id = 'detail-item-' + index;

                        newDetail.innerHTML = `
            <label for="header-${dataId}-${index}">Judul</label>
            <input type="text" class="form-control" id="header-${dataId}-${index}" name="header[]" required>
            
            <label for="nominal-${dataId}-${index}">Nominal</label>
            <input type="text" class="form-control" id="nominal-${dataId}-${index}" name="nominal[]" required>
            
            <button type="button" class="btn btn-danger remove-detail" data-index="${index}">
                <i class="fas fa-minus"></i> Hapus
            </button>
        `;

                        container.appendChild(newDetail);
                    });

                    document.querySelector('.modal-body').addEventListener('click', function(event) {
                        if (event.target.classList.contains('remove-detail')) {
                            var index = event.target.getAttribute('data-index');
                            var detailItem = document.getElementById('detail-item-' + index);
                            detailItem.remove();
                        }
                    });
                </script>



                <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
                </script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
                </script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
                </script>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.format-rp').forEach(input => {
        input.addEventListener('blur', function() {
            const rawValue = this.value.replace(/[^\d]/g, '');
            this.dataset.rawValue = rawValue;
            this.value = 'Rp. ' + new Intl.NumberFormat('id-ID').format(rawValue);
        });
    });

    document.querySelector('form').addEventListener('submit', function() {
        document.querySelectorAll('.format-rp').forEach(input => {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = input.name;
            hiddenInput.value = input.dataset.rawValue;
            this.appendChild(hiddenInput);
        });
    });
</script>

@endsection