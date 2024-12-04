@extends('layoutclient.main')
@section('content')

<div>
    <div class="page-title dark-background" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Ayat Harian {{$gereja->name}}</h1>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('main', ['domain' => $gereja->domain]) }}">Beranda</a></li>
                    <li class="current">Ayat Harian</li>
                </ol>
            </div>
        </nav>
    </div>


    <!-- Modal untuk menampilkan ayat harian -->
    <div id="ayatModal" class="modal fade show" role="dialog" style="display: block; background: rgba(0,0,0,0.8);">
        <div class="container mt-4">
            <form id="searchAyatForm">
                <div class="row">
                    <div class="col-md-4">
                        <input type="date" class="form-control" id="searchTanggal" name="searchTanggal">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-primary" id="searchBtn">Cari</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <strong style="font-size: 30px;">Ayat Harian
                        <small>"{{ \Carbon\Carbon::parse($currentAyat->tanggal)->locale('id')->isoFormat('dddd, YYYY-MM-DD') }}"</small>
                    </strong>
                </div>
                <div class="card border-success">
                    <div class="card-header bg-info text-white" style="font-size: 23px;">
                        <strong>
                            <div style="display: flex; align-items: center;">
                                <img src="../assets/img/logo1.png" alt="..."
                                    style="width: 70px; height: auto; margin-right: 10px;">
                                Ayat Harian "{{ $currentAyat->tema }}"
                            </div>
                        </strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table cart">
                                    <tr>
                                        <th><strong>Tema :</strong></th>
                                        <td>{{ $currentAyat->tema }}</td>
                                    </tr>
                                    <tr>
                                        <th><strong>Tertulis pada:</strong></th>
                                        <td>{{ $currentAyat->ayat }}</td>
                                    </tr>
                                    <tr>
                                        <th><strong>Isi Ayat :</strong></th>
                                        <td>{{ $currentAyat->isi_ayat }}</td>
                                    </tr>
                                    <tr>
                                        <th><strong>Penjelasan / Renungan :</strong></th>
                                        <td>{{ $currentAyat->detail }}</td>
                                    </tr>
                                    <tr>
                                        <th><strong>Pembuat :</strong></th>
                                        <td>{{ $currentAyat->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th><strong>Tanggal Ayat:</strong></th>
                                        <td>{{ \Carbon\Carbon::parse($currentAyat->tanggal)->locale('id')->isoFormat('dddd, YYYY-MM-DD') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><strong>Ditambahkan pada:</strong></th>
                                        <td>{{ \Carbon\Carbon::parse($currentAyat->created_at)->locale('id')->isoFormat('dddd, YYYY-MM-DD') }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="footer text-center">
                        <button class="btn btn-primary mx-2" id="previousBtn">Sebelumnya</button>
                        <button class="btn btn-primary mx-2" id="nextBtn">Berikutnya</button>
                        <button class="btn btn-danger mx-2" id="closeModal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const ayats = @json($ayats);
    let currentIndex = 0;

    document.getElementById('searchBtn').addEventListener('click', () => {
        const selectedDate = document.getElementById('searchTanggal').value;

        if (!selectedDate) {
            alert('Pilih tanggal terlebih dahulu!');
            return;
        }

        // Temukan ayat dengan tanggal yang sesuai
        const foundAyatIndex = ayats.findIndex(ayat => ayat.tanggal === selectedDate);

        if (foundAyatIndex === -1) {
            alert('Ayat pada tanggal yang dipilih tidak ditemukan.');
            return;
        }

        // Perbarui modal dengan ayat yang ditemukan
        currentIndex = foundAyatIndex;
        updateModal(currentIndex);
    });



    // Function to update modal content
    function updateModal(index) {
        if (index < 0 || index >= ayats.length) {
            alert('Data ayat tidak tersedia untuk indeks tersebut.');
            return;
        }
        const ayat = ayats[index];
        document.querySelector('.modal-header small').innerText = new Date(ayat.tanggal).toLocaleDateString('id-ID', {
            weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
        });
        document.querySelector('.card-header strong div').innerText = `Ayat Harian "${ayat.tema}"`;
        document.querySelectorAll('.table.cart td')[0].innerText = ayat.tema;
        document.querySelectorAll('.table.cart td')[1].innerText = ayat.ayat;
        document.querySelectorAll('.table.cart td')[2].innerText = ayat.isi_ayat;
        document.querySelectorAll('.table.cart td')[3].innerText = ayat.detail;
        document.querySelectorAll('.table.cart td')[4].innerText = ayat.user.name;
        document.querySelectorAll('.table.cart td')[5].innerText = new Date(ayat.tanggal).toLocaleDateString('id-ID', {
            weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
        });
        document.querySelectorAll('.table.cart td')[6].innerText = new Date(ayat.created_at).toLocaleDateString('id-ID', {
            weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
        });
    }

    document.getElementById('previousBtn').addEventListener('click', () => {
        if (currentIndex < ayats.length - 1) {
            currentIndex++;
            updateModal(currentIndex);
        }

    });

    document.getElementById('nextBtn').addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
            updateModal(currentIndex);
        }
    });

    document.getElementById('closeModal').addEventListener('click', () => {
        document.getElementById('ayatModal').style.display = 'none';
    });

    // Initialize modal with the first ayat
    updateModal(currentIndex);
</script>

@endsection
