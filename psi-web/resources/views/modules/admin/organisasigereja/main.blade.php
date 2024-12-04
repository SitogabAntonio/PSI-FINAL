@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid py-4">
        <div class="card">

            <div class="card-body pt-4 p-3">
                <form action="{{ url('/organisasigereja/create') }}" method="POST" role="form text-left"
                    enctype="multipart/form-data" id="bphForm">
                    @csrf
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

                    <div id="form-container">
                        <div class="row form-item">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="jabatan" class="form-control-label">{{ __('Jabatan') }}</label>
                                    <input class="form-control" type="text" placeholder="Isi Jabatan..." name="jabatan" value="{{ old('jabatan') }}">
                                    @error('jabatan')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nama" class="form-control-label">{{ __('Nama') }}</label>
                                    <input class="form-control" type="text" placeholder="Isi Nama..." name="nama" value="{{ old('nama') }}">
                                    @error('nama')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 position-relative">
                                <div class="form-group">
                                    <label for="foto" class="form-control-label">{{ __('Foto') }}</label>
                                    <input class="form-control" type="file" name="foto" accept="image/*">
                                    @error('foto')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                    <!-- Hapus button with X logo for subsequent forms -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="button" id="addFormButton" class="btn bg-gradient-primary btn-md mt-4 mb-4">{{ __('Tambah BPH') }}</button>
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ __('Simpan Data') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    document.getElementById('addFormButton').addEventListener('click', function () {
        const formContainer = document.getElementById('form-container');
        const formItem = document.querySelector('.form-item');
        const newFormItem = formItem.cloneNode(true);

        // Clear input values in the cloned form
        newFormItem.querySelectorAll('input').forEach(input => input.value = '');

        // Add "Hapus" button only to new forms
        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.classList.add('btn', 'btn-danger', 'btn-sm', 'position-absolute');
        removeButton.style.cssText = 'top: 50%; right: -20px; transform: translateY(-50%);';
        removeButton.innerHTML = '<i class="fa fa-times" aria-hidden="true"></i>';
        removeButton.onclick = function () {
            // Prevent removal if it's the only form
            if (formContainer.querySelectorAll('.form-item').length > 1) {
                newFormItem.remove();
            } else {
                alert("Sistem harus memiliki setidaknya 1 form.");
            }
        };

        // Append the "Hapus" button to the file input container
        newFormItem.querySelector('.col-md-4.position-relative .form-group').appendChild(removeButton);

        // Append the new form item to the container
        formContainer.appendChild(newFormItem);
    });
</script>

<style>
    .org-position {
        text-align: center;
        margin: 20px;
    }

    .org-image {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
    }

    .connector {}
</style>

@endsection
