@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0">{{ __('Sejarah Gereja') }}</h6>

            </div>

            <div class="card-body pt-4 p-3">
                <form
                    action="{{ $sejarah ? url('/sejarah/update/' . $sejarah->id) : url('/sejarah/create') }}"
                    method="POST" role="form text-left"
                    enctype="multipart/form-data">
                    @csrf
                    @if($sejarah)
                    @method('PUT')
                    @endif
                    @if($errors->any())
                    <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                        <span class="alert-text text-white">{{ $errors->first() }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                    @endif
                    @if(session('success'))
                    <div class="m-3 alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                        <span class="alert-text text-white">{{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                    @endif
                    <div class="row">
                        <div>
                            <div class="form-group">
                                {{ $sejarah && $sejarah->sejarah ? '' : 'Sejarah Gereja belum ditambahkan, silahkan tambahkan.' }}
                                <div class="@error('sejarah') border border-danger rounded-3 @enderror">
                                    <textarea class="form-control isi_renungan" type="text" rows="10" placeholder="Isi Sejarah Gereja..." id="sejarah"
                                        name="sejarah" value="{{ $sejarah->sejarah ?? '' }}">{{$sejarah->sejarah??''}}</textarea>
                                    @error('sejarah')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit"
                            class="btn bg-gradient-dark btn-md mt-4 mb-4">
                            {{ $sejarah && $sejarah->sejarah ? 'Simpan Perubahan' : 'Simpan Data' }}
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@endsection