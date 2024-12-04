@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Tambah Ayat Harian') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="/ayatharian/create" method="POST" role="form text-left">
                    @csrf
                    @if($errors->any())
                        <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                                {{$errors->first()}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                            <span class="alert-text text-white">
                                {{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tema" class="form-control-label">{{ __('Tema Ayat Harian') }}</label>
                                <div class="@error('ayatharians.tema')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Isi Tema..." id="tema"
                                        name="tema">
                                    @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ayat" class="form-control-label">{{ __('Pasal Ayat') }}</label>
                                <div class="@error('email')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="Isi Pasal - Ayat..." id="ayat"
                                        name="ayat">
                                    @error('email')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="isi_ayat">{{ 'Isi Ayat' }}</label>
                        <div class="@error('ayatharians.isi_ayat')border border-danger rounded-3 @enderror">
                            <textarea class="form-control" id="isi_ayat" rows="3" placeholder="Isi Ayat..."
                                name="isi_ayat"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="detail">{{ 'Detail Ayat' }}</label>
                        <div class="@error('ayatharians.detail')border border-danger rounded-3 @enderror">
                            <textarea class="form-control" id="detail" rows="3" placeholder="Detail Ayat..."
                                name="detail"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal Ayat Harian</label>
                        <input type="date" class="form-control" name="tanggal" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit"
                            class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Simpan Perubahan' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection