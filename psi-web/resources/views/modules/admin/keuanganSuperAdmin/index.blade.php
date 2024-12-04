@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Daftar Gereja</h5>
                        <form action="/keuangan/superadmin" class="d-flex align-items-center">

                            <div class="input-group mb-0">
                                <input type="text" class="form-control" placeholder="Cari Gereja" name="search"
                                    value="{{ request('search') }}">
                                <span class="input-group-text" id="basic-addon1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg>
                                </span>
                            </div>
                        </form>

                    </div>

                    <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                    <thead>
                                <tr class="text-center">
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        <strong>No</strong>
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        <strong>Nama Gereja</strong>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $index => $user)
                                <tr class="text-center">
                                    <td class="text-xs font-weight-bold mb-0">{{ $users->firstItem() + $index }}</td>
                                    <td class="text-xs font-weight-bold mb-0">
                                        <a href="{{ route('keuangan.superadmin.main', ['id' => $user->id]) }}" class="user-link">
                                            {{ $user->name }}
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="text-center">Tidak Gereja yang ditemukan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-end">
                            {{ $users->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .user-link {
        text-decoration: none;
        color: #007bff;
        font-weight: 600;
    }

    .user-link:hover {
        text-decoration: underline;
        color: #0056b3;
        cursor: pointer;
    }
</style>

@endsection