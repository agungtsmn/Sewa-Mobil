@extends('layout.admin')

@push('css')
  <!-- vendor css -->
  <link href="{{ asset('template') }}/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="{{ asset('template') }}/lib/Ionicons/css/ionicons.css" rel="stylesheet">
  <link href="{{ asset('template') }}/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
  <link href="{{ asset('template') }}/lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
  <link href="{{ asset('template') }}/lib/highlightjs/github.css" rel="stylesheet">

  <!-- Bracket CSS -->
  <link rel="stylesheet" href="{{ asset('template') }}/css/bracket.css">

  <style>
    .modal-dialog{
      width: 90%;
    }

    .box-img{
      height: 280px;
    }
  </style>
@endpush

@section('content')
  <!-- ########## START: MAIN PANEL ########## -->
  <div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="/">Sewa Mobil</a>
        <span class="breadcrumb-item active">Home</span>
      </nav>
    </div><!-- br-pageheader -->
    
    @include('partials.crud-alert')

    <div class="pd-x-20 pd-sm-x-30 pd-t-2 d-flex align-items-center justify-content-between flex-wrap">
      <div>
        <h4 class="tx-gray-800 mg-b-5">Penyedia Layanan Penyewaan Mobil</h4>
        <p class="mg-b-0">Galeri rental mobil terlengkap dan termurah di Bengkalis</p>
      </div>
    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">

        <div class="row">
          @foreach ($cars as $car)
            <div class="col-lg-4 mg-b-20">
              <div class="card">
                <div class="box-img">
                  <img class="card-img-top img-fluid py-5" src="{{ Storage::url($car->car_img) }}" alt="Image">
                </div>
                <div class="card-body">
                  {{-- <p class="card-text">Sewa</p> --}}
                  <b>{{ $car->merk }} {{ $car->model }}</b>
                  <p>{{ $car->plat_number }}</p>
                  <h3>{{ $car->formatRupiah('rental_rates')}} / Hari</h3>
                  @if (!Auth::user())
                    <a href="/page/login" class="btn btn-teal mt-3 w-100">Sewa Mobil</a>
                  @else
                    @if (Auth::user()->role == 'Pelanggan')
                      <a href="" class="btn btn-teal mt-3 w-100" data-toggle="modal" data-target="#modalCreateCar{{ $car->id }}">Sewa Mobil</a>
                      <div id="modalCreateCar{{ $car->id }}" class="modal fade">
                        <div class="modal-dialog modal-dialog-vertical-center" role="document">
                          <form action="/booking" method="POST" class="modal-content bd-0 tx-14" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header pd-y-20 pd-x-25">
                              <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Sewa Mobil</h6>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body pd-25">
                              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                              <input type="hidden" name="car_id" value="{{ $car->id }}">
                              <div class="form-group">
                                <label class="form-control-label">Tanggal Mulai Menyewa: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="date" name="start_date" placeholder="Masukkan merek" required>
                              </div>
                              <div class="form-group">
                                <label class="form-control-label">Tanggal Selesai Menyewa: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="date" name="finish_date" placeholder="Masukkan model" required>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-teal tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Submit</button>
                              <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
                            </div>
                          </form>
                        </div><!-- modal-dialog -->
                      </div><!-- modal -->
                    @endif
                  @endif
                </div>
              </div><!-- card -->
            </div>
          @endforeach
        </div>

      </div><!-- br-section-wrapper -->
    </div><!-- br-pagebody -->

    @include('partials.footer')

  </div><!-- br-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->
@endsection

@push('js')
  {{-- sweetalert2 --}}
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <script src="{{ asset('template') }}/lib/jquery/jquery.js"></script>
  <script src="{{ asset('template') }}/lib/popper.js/popper.js"></script>
  <script src="{{ asset('template') }}/lib/bootstrap/bootstrap.js"></script>
  <script src="{{ asset('template') }}/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
  <script src="{{ asset('template') }}/lib/moment/moment.js"></script>
  <script src="{{ asset('template') }}/lib/jquery-ui/jquery-ui.js"></script>
  <script src="{{ asset('template') }}/lib/jquery-switchbutton/jquery.switchButton.js"></script>
  <script src="{{ asset('template') }}/lib/peity/jquery.peity.js"></script>
  <script src="{{ asset('template') }}/lib/highlightjs/highlight.pack.js"></script>

  <script src="{{ asset('template') }}/js/bracket.js"></script>
@endpush