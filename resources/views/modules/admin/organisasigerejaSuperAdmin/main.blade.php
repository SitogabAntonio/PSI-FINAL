@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white">
            <strong>Super Admin berhak menghapus Struktural BPH Gereja</strong>
        </span>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">

                        <h5 class="mb-0">Semua BPH Gereja</h5>

                        <form action="/organisasigereja/superadmin" class="d-flex align-items-center">
                            <div class="input-group mb-0">
                                <input type="text" class="form-control" placeholder="Cari BPH Gereja..."
                                    name="search" value="{{ request('search') }}">
                                <span class="input-group-text" id="basic-addon1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive p-0">

                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        No
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Gereja
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama Pendeta
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($organisasigerejasuperadmin as $key => $item)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $organisasigerejasuperadmin->firstItem() + $key }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$item->user->name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$item->pendeta}}</p>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="badge bg-info" data-bs-toggle="modal"
                                            data-bs-target="#orgChartModal" data-pendeta="{{ $item->pendeta }}"
                                            data-guru_huria="{{ $item->guru_huria }}"
                                            data-bibelvroh="{{ $item->biblevroh }}"
                                            data-bendahara_gereja="{{ $item->bendahara_gereja }}"
                                            data-sekretaris_gereja="{{ $item->sekretaris_gereja }}"

                                            data-image_pendeta="{{ $item->image_pendeta }}"
                                            data-image_guru_huria="{{ $item->image_guru_huria }}"
                                            data-image_biblevroh="{{ $item->image_biblevroh }}"
                                            data-image_bendahara_gereja="{{ $item->image_bendahara_gereja }}"
                                            data-image_sekretaris_gereja="{{ $item->image_sekretaris_gereja }}">


                                            Lihat
                                        </a>

                                        <a href="{{ url('/organisasigereja/superadmin/detele', $item->id) }}"
                                            class="badge bg-secondary  border-0 deleteKategory">Hapus</a> </span>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                        @if($organisasigerejasuperadmin->isEmpty())
                        <div style="margin-top: 50px;">
                            <p class="text-center mb-3">Tidak ada data BPH Gereja.</p>
                        </div>

                        @endif
                    </div>

                    <br>
                    {{ $pagination->links() }}




                    <div class="modal fade" id="orgChartModal" tabindex="-1" aria-labelledby="orgChartModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="orgChartModalLabel">Struktur Organisasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="hierarchy">
                                        <div class="org-position">Pendeta : <small>({{ $organisasigerejasuperadmin->pendeta ?? 'Nama belum diisi' }})</small> <br>

                                        </div>
                                        <div class="connector"></div>
                                        <div class="hierarchy-row">
                                            <div class="org-position me-4">Guru Huria : <small>({{ $organisasigerejasuperadmin->guru_huria ?? 'Nama belum diisi' }})</small>
                                                <br>
                                            </div>
                                            <div class="org-position">Bibelvroh <br>
                                                <small>({{ $organisasigerejasuperadmin->biblevroh ?? 'Nama belum diisi' }})</small>
                                            </div>
                                        </div>
                                        <div class="hierarchy-row">
                                            <div class="org-position me-4">Bendahara Gereja : <small>({{ $organisasigerejasuperadmin->bendahara_gereja ?? 'Nama belum diisi' }})</small>
                                                <br>
                                            </div>
                                            <div class="org-position">Sekretaris Gereja <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var myModal = document.getElementById('orgChartModal');
    myModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var pendeta = button.getAttribute('data-pendeta');
        var guru_huria = button.getAttribute('data-guru_huria');
        var bibelvroh = button.getAttribute('data-bibelvroh');
        var bendahara_gereja = button.getAttribute('data-bendahara_gereja');
        var sekretaris_gereja = button.getAttribute('data-sekretaris_gereja');

        var image_pendeta = button.getAttribute('data-image_pendeta');
        var image_guru_huria = button.getAttribute('data-image_guru_huria');
        var image_biblevroh = button.getAttribute('data-image_biblevroh');
        var image_bendahara_gereja = button.getAttribute('data-image_bendahara_gereja');
        var image_sekretaris_gereja = button.getAttribute('data-image_sekretaris_gereja');

        var modalTitle = myModal.querySelector('.modal-title');
        modalTitle.textContent = 'Struktur Organisasi';

        var modalBody = myModal.querySelector('.modal-body .hierarchy');
        modalBody.innerHTML = `
    ${pendeta ? `
        <div class="org-position">Pendeta : <small>(${pendeta})</small><br>
            ${image_pendeta ? `<img src="data:image/jpeg;base64,${image_pendeta}" class="img-fluid img-thumbnail org-image" alt="Pendeta Image">` : '<small>Foto tidak ada</small>'}
        </div>
    ` : ''}

    <div class="connector"></div>

    <div class="hierarchy-row">
        ${guru_huria ? `
            <div class="org-position me-4">Guru Huria : <small>(${guru_huria})</small><br>
                ${image_guru_huria ? `<img src="data:image/jpeg;base64,${image_guru_huria}" class="img-fluid img-thumbnail org-image" alt="Guru Huria Image">` : '<small>Foto tidak ada</small>'}
            </div>
        ` : ''}

        ${bibelvroh ? `
            <div class="org-position">Bibelvroh : <small>(${bibelvroh})</small><br>
                ${image_biblevroh ? `<img src="data:image/jpeg;base64,${image_biblevroh}" class="img-fluid img-thumbnail org-image" alt="Bibelvroh Image">` : '<small>Foto tidak ada</small>'}
            </div>
        ` : ''}
    </div>

    <div class="hierarchy-row">
        ${bendahara_gereja ? `
            <div class="org-position me-4">Bendahara Gereja : <small>(${bendahara_gereja})</small><br>
                ${image_bendahara_gereja ? `<img src="data:image/jpeg;base64,${image_bendahara_gereja}" class="img-fluid img-thumbnail org-image" alt="Bendahara Gereja Image">` : '<small>Foto tidak ada</small>'}
            </div>
        ` : ''}

        ${sekretaris_gereja ? `
            <div class="org-position">Sekretaris Gereja : <small>(${sekretaris_gereja})</small><br>
                ${image_sekretaris_gereja ? `<img src="data:image/jpeg;base64,${image_sekretaris_gereja}" class="img-fluid img-thumbnail org-image" alt="Sekretaris Gereja Image">` : '<small>Foto tidak ada</small>'}
            </div>
        ` : ''}
    </div>
`;

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