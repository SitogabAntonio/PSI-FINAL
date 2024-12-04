@extends('layoutclient.main')
@section('content')

<div>
    <section id="hero" class="hero section dark-background">
        <img src="https://answeredfaith.com/wp-content/uploads/2024/03/music-in-worship-scaled.webp" alt=""
            data-aos="fade-in">
        <div class="container">
            <div class="row justify-content-center text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="col-xl-6 col-lg-8">
                    <h2>Penyertaan Tuhan di Tengah Kita<span>.</span></h2>
                    <p>Tuhan Memberkati Kita</p>
                </div>
            </div>
            <div class="row gy-4 mt-5 justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="icon-box">
                        <i class="bi bi-person-arms-up"></i>
                        <h3><a href="#">Damai dan Sejahtera</a></h3>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="icon-box">
                        <i class="bi bi-bullseye"></i>
                        <h3><a href="#">Penyertaan Tuhan di Tengah Kita</a></h3>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="icon-box">
                        <i class="bi bi-door-open-fill"></i>
                        <h3><a href="#">Datanglah dan Pintu Akan Dibukakan Bagimu</a></h3>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="icon-box">
                        <i class="bi bi-people-fill"></i>
                        <h3><a href="#">Ketahuilah Bahwa Dia Selalu Bersama Kita.</a></h3>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- Section Jadwal -->
    <section id="jadwal" class="jadwal section">
        <div class="container section-title" data-aos="fade-up">
            <h3><strong>Jadwal Ibadah</strong></h3>
        </div>
        <div class="container">
            <div class="row gy-4 justify-content-center">
                <!-- Baris 1 (4 card) -->
                <div class="col-xl-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="card border-warning shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title">Kebaktian Minggu I</h5>
                            <p class="card-text">Jam: 08:00 WIB</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="card border-warning shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title">Kebaktian Sekolah Minggu</h5>
                            <p class="card-text">Jam: 10:00 WIB</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="card border-warning shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title">Kebaktian Muda/i Remaja</h5>
                            <p class="card-text">Jam: 13:00 WIB</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="card border-warning shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title">Kebaktian Doa Syafaat</h5>
                            <p class="card-text">Jam: 18:00 WIB</p>
                        </div>
                    </div>
                </div>

                <!-- Baris 2 (4 card) -->
                <div class="col-xl-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="700">
                    <div class="card border-warning shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title">Kebaktian KKS</h5>
                            <p class="card-text">Jam: 19:00 WIB</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="800">
                    <div class="card border-warning shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title">Doa Puasa</h5>
                            <p class="card-text">Jam: 10:00 WIB</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="900">
                    <div class="card border-warning shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title">Kebaktian Keluarga</h5>
                            <p class="card-text">Jam: 17:00 WIB</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="1000">
                    <div class="card border-warning shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title">TDRK</h5>
                            <p class="card-text">Jam: 14:00 WIB</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="about" class="about section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">

                <div class="content">
                    <h3>Visi</h3>
                    <ul>
                        @if ($gereja && $gereja->visi->isNotEmpty())
                            @foreach ($gereja->visi as $visi)
                                <li><i class="bi bi-check2-all"></i> <span>{{ $visi->title_visi }}</span></li>
                            @endforeach
                        @else
                            <li><i class="bi bi-check2-all"></i> <span>Visi tidak tersedia.</span></li>
                        @endif
                    </ul>
                    <h3>Misi</h3>
                    <ul>
                        @if ($gereja && $gereja->misi->isNotEmpty())
                            @foreach ($gereja->misi as $misi)
                                <li><i class="bi bi-check2-all"></i> <span>{!! $misi->title_misi !!}</span></li>
                            @endforeach
                        @else
                            <li><i class="bi bi-check2-all"></i> <span>Misi tidak tersedia.</span></li>
                        @endif
                    </ul>
                </div>
                <div class="content">
                    <h3>Sejarah</h3>
                    <p class="fst-italic">
                        @if ($gereja && $gereja->sejarah)
                            {{ $gereja->sejarah->sejarah }}
                        @else
                            <p>Sejarah tidak tersedia.</p>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="team" class="team section">
    <div class="container">
        <h2 class="fw-bold" data-aos="fade-up">{{ $gereja->name }}</h2>
        <p class="text-muted" data-aos="fade-up" data-aos-delay="100">{{ $gereja->about_me }}</p>
        <div class="card-container">
            @forelse ($bphList as $bph)
                <div class="card-pengurus-main" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="card-header p-0">
                        @if ($bph->foto)
                            <img src="data:image/jpeg;base64,{{ $bph->foto }}" alt="Foto {{ $bph->nama }}"
                                class="card-pengurus-img">
                        @else
                            <img src="https://via.placeholder.com/200" alt="Foto tidak tersedia"
                                class="card-pengurus-img">
                        @endif
                    </div>
                    <div class="card-pengurus-body">
                        <h5 class="card-pengurus-title">{{ $bph->nama ?? 'Tidak ada nama' }}</h5>
                        <p class="card-pengurus-text">{{ $bph->jabatan ?? 'Tidak ada jabatan' }}</p>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted" data-aos="fade-up">Data pengurus gereja belum tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>






    <section id="contact" class="contact section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Kontak</h2>
            <p>Hubungi Kami</p>
        </div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="200">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.5158196719935!2d99.05784667496812!3d2.3313768976482785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e05c95f52b829%3A0xed938e8b08109ff8!2sGKII%20Balige!5e0!3m2!1sid!2sid!4v1732868824690!5m2!1sid!2sid"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                        <i class="bi bi-geo-alt flex-shrink-0"></i>
                        <div>
                            <h3>Alamat</h3>
                            <p>{{$gereja->location}}</p>
                        </div>
                    </div>
                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                        <i class="bi bi-telephone flex-shrink-0"></i>
                        <div>
                            <h3>No Telepon</h3>
                            <p>{{$gereja->phone}}</p>
                        </div>
                    </div>
                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                        <i class="bi bi-envelope flex-shrink-0"></i>
                        <div>
                            <h3>Email</h3>
                            <p>{{$gereja->email}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<style>
    .pengurus {
        padding: 50px 0;
        background-color: #f8f9fa;
    }

    .pengurus h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        border-color: #ffc451;
    }

    .card-pengurus-main {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        width: 250px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
        overflow: hidden;
        transform: translateY(50px);
        transition: all 0.5s ease-in-out;
    }
    .card-pengurus-main.show {
        opacity: 1;
        transform: translateY(0);
    }

    .card-pengurus-main:hover {
        transform: translateY(-10px); /* Mengangkat kartu */
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); /* Bayangan lebih besar */
        border-color: #ffc451; /* Warna bingkai berubah menjadi #ffc451 */
    }

    .card-pengurus-img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-bottom: 1px solid #ddd;
        transition: filter 0.3s; /* Efek filter gambar saat hover */
    }

    .card-pengurus-main:hover .card-pengurus-img {
        filter: brightness(0.9); /* Sedikit gelap saat hover */
    }

    .card-pengurus-body {
        padding: 15px;
    }

    .card-pengurus-title {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 5px;
        transition: color 0.3s; /* Warna teks berubah saat hover */
    }

    .card-pengurus-main:hover .card-pengurus-title {
        color: #ffc451;
    }

    .card-pengurus-text {
        font-size: 0.9rem;
        color: #6c757d;
        transition: color 0.3s; /* Warna teks berubah saat hover */
    }

    .card-pengurus-main:hover .card-pengurus-text {
        color: #ffc451;
    }



    .content-left {
        width: 48%;
    }

    .content-right {
        width: 48%;
        text-align: right;
    }

    .info-item {
        margin-bottom: 20px;
    }

    .card {
        border-radius: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        width: 100%;
        height: 100px;
        /* Tinggi card di-set agar sama */
        border: 2px solid #ffc451;
        /* Mengubah border menjadi #ffc451 */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        /* Menjaga agar isi tetap teratur */
    }

    .card-body {
        padding: 20px;
        flex: 1;
        /* Memastikan konten mengisi seluruh ruang yang ada */
        display: flex;
        flex-direction: column;
        justify-content: center;
        /* Menyusun konten secara vertikal */
        text-align: center;
        /* Menyusun teks di tengah */
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
        color: #333;
    }

    .card-text {
        font-size: 16px;
        color: #555;
    }

    /* Hover effect */
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }

    /* Responsive Layout */
    .col-xl-3,
    .col-md-4,
    .col-6 {
        display: flex;
        justify-content: center;
        align-items: stretch;
        /* Memastikan card memiliki tinggi yang seragam */
    }

    @media (max-width: 768px) {
        .col-xl-3 {
            flex: 1 1 45%;
            margin: 10px 0;
        }
    }

    @media (max-width: 576px) {
        .col-xl-3 {
            flex: 1 1 100%;
            margin: 10px 0;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cards = document.querySelectorAll('.card-pengurus-main');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('show');
                }
            });
        });

        cards.forEach(card => observer.observe(card));
    });
</script>


@endsection
