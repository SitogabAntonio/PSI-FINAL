@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Tambah Visi Gereja') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="/visi-misi/createvisi" method="POST" role="form text-left">
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
                  
                  
                    <div class="form-group">
                        <div class="@error('visi.title_visi')border border-danger rounded-3 @enderror">
                            <textarea class="form-control" id="title_visi" rows="3" placeholder="Detail Visi..."
                                name="title_visi"></textarea>
                        </div>
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