@extends('layout.admin')

@push('css')
  <!-- vendor css -->
  <link href="{{ asset('template') }}/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="{{ asset('template') }}/lib/Ionicons/css/ionicons.css" rel="stylesheet">
  <link href="{{ asset('template') }}/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
  <link href="{{ asset('template') }}/lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
  <link href="{{ asset('template') }}/lib/highlightjs/github.css" rel="stylesheet">
  <link href="{{ asset('template') }}/lib/datatables/jquery.dataTables.css" rel="stylesheet">
  <link href="{{ asset('template') }}/lib/select2/css/select2.min.css" rel="stylesheet">

  <!-- Bracket CSS -->
  <link rel="stylesheet" href="{{ asset('template') }}/css/bracket.css">

  <style>
    .modal-dialog{
      width: 90%;
    }

    .car-img{
      width: 100px;
      object-fit: cover;
      margin-right: 10px;
    }
  </style>
@endpush

@section('content')
  <!-- ########## START: MAIN PANEL ########## -->
  <div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="/dashboard">Admin Panel</a>
        <a class="breadcrumb-item" href="/manage/car">Kelola Data</a>
        <span class="breadcrumb-item active">Mobil</span>
      </nav>
    </div><!-- br-pageheader -->
    
    @include('partials.crud-alert')

    <div class="pd-x-20 pd-sm-x-30 pd-t-2 d-flex align-items-center justify-content-between flex-wrap">
      <div>
        <h4 class="tx-gray-800 mg-b-5">Pengelolaan Data Mobil</h4>
        <p class="mg-b-0">Melihat, menambah, mengedit, dan menghapus data mobil</p>
      </div>
      
      <!-- BASIC MODAL -->
      <a href="" class="btn btn-teal" data-toggle="modal" data-target="#modalCreateCar">Tambah Data <i class="bi bi-plus"></i></a>
      <div id="modalCreateCar" class="modal fade">
        <div class="modal-dialog modal-dialog-vertical-center" role="document">
          <form action="/manage/car" method="POST" class="modal-content bd-0 tx-14" enctype="multipart/form-data">
            @csrf
            <div class="modal-header pd-y-20 pd-x-25">
              <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Tambah Data Mobil</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body pd-25">
              <div class="form-group">
                <label class="form-control-label">Merek: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="merk" placeholder="Masukkan merek" required>
              </div>
              <div class="form-group">
                <label class="form-control-label">Model: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="model" placeholder="Masukkan model" required>
              </div>
              <div class="form-group">
                <label class="form-control-label">Nomor Plat: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="plat_number" placeholder="Masukkan nomor plat" required>
              </div>
              <div class="form-group">
                <label class="form-control-label">Harga Sewa / Hari: <span class="tx-danger">*</span></label>
                <input class="form-control" type="number" min="0" name="rental_rates" placeholder="Masukkan harga sewa" required>
              </div>
              <div class="form-group">
                <label class="form-control-label">Foto Mobil: <span class="tx-danger">*</span></label>
                <input class="form-control" type="file" name="car_img" placeholder="Masukkan foto mobil" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-teal tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Submit</button>
              <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div><!-- modal-dialog -->
      </div><!-- modal -->

    </div>

    <div class="br-pagebody">
      <div class="br-section-wrapper">

        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-5p text-center">No</th>
                <th class="wd-20p">Merek</th>
                <th class="wd-20p">Model</th>
                <th class="wd-20p">Nomor Plat</th>
                <th class="wd-20p">Harga Sewa / Hari</th>
                <th class="wd-10p">Keadaan</th>
                <th class="wd-15p text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $dataCar)
                <tr>
                  <td class="text-center">{{ $loop->iteration }}</td>
                  <td>
                    <img class="car-img" src="{{ Storage::url($dataCar->car_img) }}" alt="">
                    {{ $dataCar->merk }}
                  </td>
                  <td class="align-middle">{{ $dataCar->model }}</td>
                  <td class="align-middle">{{ $dataCar->plat_number }}</td>
                  <td class="align-middle">{{ $dataCar->rental_rates }}</td>
                  <td class="align-middle">{{ $dataCar->status }}</td>
                  <td>
                    <div class="d-flex justify-content-center">
                      {{-- Tombol Modal Update --}}
                      <a href="" class="btn btn-warning tx-10 pd-x-10 pd-y-5 mr-2" data-toggle="modal" data-target="#modalUpdateCar{{ $dataCar->id }}"><i class="bi bi-pen mr-1"></i> Edit</a>
                      <div data-kode="{{ $dataCar->id }}" class="btn btn-danger tx-10 pd-x-10 pd-y-5 swal-confirm">
                        <form action="/manage/car/{{ $dataCar->id }}" id="delete{{ $dataCar->id }}" method="post">
                            @csrf
                            @method('delete')
                        </form>
                        <i class="bi bi-trash mr-1"></i>
                        Delete
                      </div>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div><!-- table-wrapper -->
        
        @foreach ($data as $dataCar)
          {{-- Modal Update --}}
          <div id="modalUpdateCar{{ $dataCar->id }}" class="modal fade">
            <div class="modal-dialog modal-dialog-vertical-center" role="document">
              <form action="/manage/car/{{ $dataCar->id }}" method="POST" class="modal-content bd-0 tx-14" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="modal-header pd-y-20 pd-x-25">
                  <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Update Data Mobil</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body pd-25">
                  <div class="form-group">
                    <label class="form-control-label">Merek: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="merk" placeholder="Masukkan merek" required value="{{ $dataCar->merk }}">
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Model: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="model" placeholder="Masukkan model" required value="{{ $dataCar->model }}">
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Nomor Plat: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="plat_number" placeholder="Masukkan nomor plat" required value="{{ $dataCar->plat_number }}">
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Harga Sewa / Hari: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="number" min="0" name="rental_rates" placeholder="Masukkan harga sewa" required value="{{ $dataCar->rental_rates }}">
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Foto Mobil:</label>
                    <input class="form-control" type="file" name="car_img" placeholder="Masukkan foto mobil">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-teal tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Submit</button>
                  <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div><!-- modal-dialog -->
          </div><!-- modal -->
        @endforeach

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
  <script src="{{ asset('template') }}/lib/datatables/jquery.dataTables.js"></script>
  <script src="{{ asset('template') }}/lib/datatables-responsive/dataTables.responsive.js"></script>
  <script src="{{ asset('template') }}/lib/select2/js/select2.min.js"></script>

  <script src="{{ asset('template') }}/js/bracket.js"></script>

  <script>
    $(function(){
      'use strict';

      $('#datatable1').DataTable({
        responsive: true,
        language: {
          searchPlaceholder: 'Search...',
          sSearch: '',
          lengthMenu: '_MENU_ items/page',
        }
      });

      $('#datatable2').DataTable({
        bLengthChange: false,
        searching: false,
        responsive: true
      });

      // Select2
      $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

    });
  </script>

  <script>
    $(".swal-confirm").click(function(e) {
        id = e.target.dataset.kode;
        if (id) {
            Swal.fire({
                title: 'Anda yakin ingin menghapus?',
                text: "Jika sudah terhapus data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#F5365C',
                cancelButtonColor: '#2DCE89',
                confirmButtonText: 'Iya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete' + id).submit();
                }
            });
        }
    });
  </script>
@endpush