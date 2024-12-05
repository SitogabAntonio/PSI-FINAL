@extends('layoutclient.main')
@section('content')

<div>
  <div class="page-title dark-background" data-aos="fade">
    <div class="heading">
      <div class="container">
        <div class="row d-flex justify-content-center text-center">
          <div class="col-lg-8">
            <h1>Event {{$gereja->name}}</h1>
          </div>
        </div>
      </div>
    </div>
    <nav class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{ route('main', ['domain' => $gereja->domain]) }}">Beranda</a></li>
          <li class="current">Event</li>
        </ol>
      </div>
    </nav>
  </div>

  <section id="service-details" class="service-details section">
    <div class="container">
      <div class="row gy-5">
        <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
          <div class="service-box">
            <h4>List Event</h4>
            <div class="table-responsive animate_animated animate_fadeInUp">
              <table class="table table-success table-striped">
                <thead>
                  <tr>
                    <th scope="col">Nama Event</th>
                    <th scope="col">Tanggal Event</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($events as $item)
                  <tr>
                    <td>{{ $item->event_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->event_start_date)->locale('id')->isoFormat('dddd, YYYY-MM-DD') }}
                    </td>
                    <td class="text-center">
                      <a href="" class="badge bg-info" data-toggle="modal"
                        data-target="#editevent-{{ $item->id }}">Lihat</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @if($gereja->events->isEmpty())
              <div style="margin-top: 50px;">
                <p class="text-center mb-3">Tidak ada data Event</p>
              </div>
              @endif
              <div class="d-flex justify-content-end">
                {{ $events->links() }}
              </div>
            </div>
            @foreach ($gereja->events as $data)
            <div id="editevent-{{ $data->id }}" class="modal fade" role="dialog">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <strong style="font-size: 30px;">Detail Event</strong>
                  </div>
                  <div class="card border-success">
                    <div class="card-header bg-info text-white" style="font-size: 23px;">
                      <img src="../assets/img/logo1.png" alt="..."
                        style="width: 70px; height: auto; margin-right: 10px;">
                      <strong> Event "{{ $data->event_name }}"</strong>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-8">
                          <div class="table-responsive">
                            <table class="table cart">

                              <tr class="cart_item">
                                <th><strong>Nama Event :</strong></th>
                                <td>{{ $data->event_name }}</td>
                              </tr>
                              <tr class="cart_item">
                                <th><strong>Deskripsi Event</strong></th>
                                <td style="word-wrap: break-word; white-space: normal;">
                                  {{ $data->event_description }}
                                </td>
                              </tr>
                              <tr class="cart_item">
                                <th><strong>Lokasi Event :</strong></th>
                                <td>{{ $data->event_location }}</td>
                              </tr>
                              <tr class="cart_item">
                                <th><strong>Tanggal Mulai Event :</strong></th>
                                <td>{{ \Carbon\Carbon::parse($data->event_start_date)->locale(locale: 'id')->isoFormat(format: 'dddd, YYYY-MM-DD') }}
                                </td>

                              </tr>
                              <tr class="cart_item">
                                <th><strong>Tanggal Berakhir Event :</strong></th>
                                <td>{{ \Carbon\Carbon::parse($data->event_end_date)->locale(locale: 'id')->isoFormat('dddd, YYYY-MM-DD') }}
                                </td>

                              </tr>
                              <tr class="cart_item">
                                <th><strong>Ditambahkan pada:</strong></th>
                                <td>{{ \Carbon\Carbon::parse($data->created_at)->locale(locale: 'id')->isoFormat('dddd, YYYY-MM-DD') }}
                                </td>

                              </tr>
                              <tr class="cart_item">
                                <th><strong>Diubah pada:</strong></th>
                                <td>{{ \Carbon\Carbon::parse($data->updated_at)->locale(locale: 'id')->isoFormat('dddd, YYYY-MM-DD') }}
                                </td>

                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="form-group">

                            <img id="current-image-{{ $data->id }}"
                              src="{{ 'data:image/jpeg;base64,' . $data->event_image }}"
                              class="img-fluid img-thumbnail" alt="Current Image"
                              style="max-width: 100%; margin-bottom: 10px;">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="footer">
                      <button class="btn btn-danger float-right my-3 mx-3" data-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>

        </div>


      </div>

    </div>

  </section>

</div>
@endsection