@extends('layouts.user_type.auth')

@section('content')

<div class="row">
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Selamat Datang...</p>
              <h5 class="font-weight-bolder mb-0">
                {{ auth()->user()->name }}
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
              <i class="text-lg" aria-hidden="true"> 😊 </i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row mt-4">
  <div class="col-lg-7 mb-lg-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-lg-6">
            <div class="d-flex flex-column h-100">
              <p class="mb-1 pt-2 text-bold">PSI-21</p>
              <h5 class="font-weight-bolder">Sitem Informasi Gereja</h5>
              <p class="mb-5">Sistem Informasi yang digunakan untuk membantu Jemaat mendapatkan Infomasi dimana dan kapan pun.</p>

            </div>
          </div>
          <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
            <div class="position-relative d-flex align-items-center justify-content-center h-100">
              <img class="w-100 position-relative z-index-2 pt-4" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbi8oMmcmsxM5Id6CuAtu19THuPBONocS4SA&s" alt="rocket">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-5">
    <div class="card h-100 p-3">
      <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" style="background-image: url('../assets/img/ivancik.jpg');">
        <span class="mask bg-gradient-dark"></span>
        <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
          <h5 class="text-white font-weight-bolder mb-4 pt-2">Informasi</h5>
          <p class="text-white">Silahkan menambah warta jemaat dan lainnya.</p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row mt-4">
</div>


@endsection
@push('dashboard')

@endpush