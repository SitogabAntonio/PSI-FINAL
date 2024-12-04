@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid py-4">
        <div class="card">

            <div class="card-body pt-4 p-3">
                <form action="{{ route('anggota.store') }}" method="POST" role="form text-left"
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
                                    <label for="keluarga" class="form-control-label">{{ __('Keluarga') }}</label>
                                    <input class="form-control" type="text" placeholder="Nama Keluarga" name="keluarga[]" value="{{ old('keluarga') }}">
                                    @error('keluarga.*')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="no_kk" class="form-control-label">{{ __('No. KK') }}</label>
                                    <input class="form-control" type="text" placeholder="Isi No. KK..." name="no_kk[]" value="{{ old('no_kk') }}">
                                    @error('no_kk.*')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 d-flex align-items-center position-relative">
                                <div class="form-group w-100">
                                    <label for="nama" class="form-control-label">{{ __('Nama') }}</label>
                                    <input class="form-control" type="text" placeholder="Isi Nama..." name="nama[]" value="{{ old('nama') }}">
                                    @error('nama.*')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Button Hapus -->
                                <button type="button" class="btn btn-danger btn-sm position-absolute delete-btn" style="right: -25px; display: none;">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="button" id="addFormButton" class="btn bg-gradient-primary btn-md mt-4 mb-4">{{ __('Tambah Anggota Keluarga') }}</button>
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ __('Simpan Data') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    // Function to add new form
    document.getElementById('addFormButton').addEventListener('click', function () {
        const formContainer = document.getElementById('form-container');
        const formItem = document.querySelector('.form-item');
        const newFormItem = formItem.cloneNode(true);

        // Clear input values in the cloned form
        newFormItem.querySelectorAll('input').forEach(input => input.value = '');

        // Show "Hapus" button for new form (except the first form)
        const deleteButton = newFormItem.querySelector('.delete-btn');
        deleteButton.style.display = 'inline-block';  // Show the delete button

        // Add "Hapus" button functionality
        deleteButton.onclick = function () {
            // Prevent removal if it's the only form
            if (formContainer.querySelectorAll('.form-item').length > 1) {
                newFormItem.remove();
            } else {
                alert("Sistem harus memiliki setidaknya 1 form.");
            }
        };

        // Append the new form item to the container
        formContainer.appendChild(newFormItem);
    });

    // Make sure that the delete button for the first form is hidden
    window.addEventListener('DOMContentLoaded', () => {
        const deleteBtns = document.querySelectorAll('.delete-btn');
        deleteBtns.forEach((btn, index) => {
            if (index === 0) {
                btn.style.display = 'none';  // Hide delete button for the first form
            }
        });
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
