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
    
  </style>
@endpush

@section('content')
  <!-- ########## START: MAIN PANEL ########## -->
  <div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="/">Sewa Mobil</a>
        <span class="breadcrumb-item active">Register</span>
      </nav>
    </div><!-- br-pageheader -->
    
    @include('partials.crud-alert')

    <div class="pd-x-20 pd-sm-x-30 pd-t-2 d-flex align-items-center justify-content-between flex-wrap">
      <div>
        <h4 class="tx-gray-800 mg-b-5">Login</h4>
        <p class="mg-b-0">Silahkan isi form dibawah untuk masuk ke sistem</p>
      </div>
    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">

        <div class="row">
          <div class="col-xl-6">
            <form action="/login" method="POST" class="form-layout form-layout-4">
              @csrf
              <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Login</h6>
              <p class="mg-b-30 tx-gray-600">Isi sesuai dengan akun anda</p>
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Username: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="text" class="form-control" name="username" placeholder="Masukkan username" required>
                </div>
              </div>
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Password: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="password" class="form-control" name="password" placeholder="Masukkan password" required>
                </div>
              </div>
              <input type="hidden" class="form-control" name="role" value="Pelanggan">
              <div class="form-layout-footer mg-t-30">
                <button type="submit" class="btn btn-info">Login</button>
              </div><!-- form-layout-footer -->
            </form><!-- form-layout -->
          </div><!-- col-6 -->
        </div><!-- row -->

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