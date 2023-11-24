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
        <h4 class="tx-gray-800 mg-b-5">Penyewaan Mobil</h4>
        <p class="mg-b-0">Galeri rental mobil terlengkap dan termurah di Bengkalis</p>
      </div>
    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">

        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Mobil Yang Disewa</h6>
        <p class="mg-b-25 mg-lg-b-50">Daftar mobil yang masih dalam masa penyewaan oleh anda</p>

        <div class="row">
          @foreach ($bookings as $booking)
            @if ($booking->status == 'Disewa')
              <div class="col-lg-4">
                <div class="card">
                  <div class="box-img">
                    <img class="card-img-top img-fluid py-5" src="{{ Storage::url($booking->car->car_img) }}" alt="Image">
                  </div>
                  <div class="card-body">
                    {{-- <p class="card-text">Sewa</p> --}}
                    <b>{{ $booking->car->merk }} {{ $booking->car->model }}</b>
                    <p>{{ $booking->car->plat_number }} <b class="bg-teal pd-x-5 pd-y-2 mg-l-5 rounded text-white">Disewa</b></p>
                    <span>Total harga sewa <h3 class="text-success">{{ $booking->formatRupiah('total_price')}}</h3></span>
                    <table class="mg-t-5">
                      <tr>
                        <td class="wd-70p">Mulai Menyewa</td>
                        <td>{{ date('d M Y', strtotime($booking->start_date)) }}</td>
                      </tr>
                      <tr>
                        <td>Selesai Menyewa</td>
                        <td>{{ date('d M Y', strtotime($booking->finish_date)) }}</td>
                      </tr>
                    </table>
                    <a href="/return/{{ $booking->id }}" class="btn btn-teal mt-3 w-100">Pengembalian Mobil</a>
                    {{-- <a href="" class="btn btn-teal mt-3 w-100" data-toggle="modal" data-target="#modalCarReturn{{ $booking->id }}">Pengembalian Mobil</a>
                    <div id="modalCarReturn{{ $booking->id }}" class="modal fade">
                      <div class="modal-dialog modal-dialog-vertical-center" role="document">
                        <form action="/return" method="POST" class="modal-content bd-0 tx-14">
                          @csrf
                          <div class="modal-header pd-y-20 pd-x-25">
                            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Pengembalian Mobil</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body pd-25">
                            <input type="hidden" name="carbooking_id" value="{{ $booking->id }}">
                            <h4 class="text-center">Selesaikan Penyewaan Mobil?</h4>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-teal tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Ya</button>
                            <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
                          </div>
                        </form>
                      </div><!-- modal-dialog -->
                    </div><!-- modal --> --}}
                  </div>
                </div><!-- card -->
              </div>
            @endif
          @endforeach
        </div>

        <h6 class="mg-t-80 tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Mobil Yang Telah Selesai Disewa</h6>
        <p class="mg-b-25 mg-lg-b-50">Daftar mobil yang telah selesai disewa oleh anda</p>

        <div class="row">
          @foreach ($bookings as $booking)
            @if ($booking->status == 'Selesai')
              <div class="col-lg-4">
                <div class="card">
                  <div class="box-img">
                    <img class="card-img-top img-fluid py-5" src="{{ Storage::url($booking->car->car_img) }}" alt="Image">
                  </div>
                  <div class="card-body">
                    {{-- <p class="card-text">Sewa</p> --}}
                    <b>{{ $booking->car->merk }} {{ $booking->car->model }}</b>
                    <p>{{ $booking->car->plat_number }} <b class="bg-warning pd-x-5 pd-y-2 mg-l-5 rounded text-white">Selesai</b></p>
                    <span>Total harga sewa <h3 class="text-success">{{ $booking->formatRupiah('total_price')}}</h3></span>
                    <table class="mg-t-5">
                      <tr>
                        <td class="wd-70p">Mulai Menyewa</td>
                        <td>{{ date('d M Y', strtotime($booking->start_date)) }}</td>
                      </tr>
                      <tr>
                        <td>Selesai Menyewa</td>
                        <td>{{ date('d M Y', strtotime($booking->finish_date)) }}</td>
                      </tr>
                    </table>
                  </div>
                </div><!-- card -->
              </div>
            @endif
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