@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Tambah Misi Gereja') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="/visi-misi/createmisi" method="POST" role="form text-left">
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
                        <div class="@error('misi.title_misi')border border-danger rounded-3 @enderror">
                            <textarea class="form-control" id="title_misi" rows="3" placeholder="Detail Misi..."
                                name="title_misi"></textarea>
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

<script>
    tinymce.init({
      selector: 'textarea#title_misi',
      plugins: 'code table lists',
      toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | ' +
      'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
      'forecolor backcolor emoticons | help'
    });
  </script>
@endsection