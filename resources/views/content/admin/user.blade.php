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
  </style>
@endpush

@section('content')
  <!-- ########## START: MAIN PANEL ########## -->
  <div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
      <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="/dashboard">Admin Panel</a>
        <a class="breadcrumb-item" href="/manage/user">Kelola Data</a>
        <span class="breadcrumb-item active">Pengguna</span>
      </nav>
    </div><!-- br-pageheader -->
    
    @include('partials.crud-alert')

    <div class="pd-x-20 pd-sm-x-30 pd-t-2 d-flex align-items-center justify-content-between flex-wrap">
      <div>
        <h4 class="tx-gray-800 mg-b-5">Pengelolaan Data Pengguna</h4>
        <p class="mg-b-0">Melihat, menambah, mengedit, dan menghapus data Pengguna</p>
      </div>
      
      <!-- BASIC MODAL -->
      <a href="" class="btn btn-teal" data-toggle="modal" data-target="#modalCreateUser">Tambah Data <i class="bi bi-plus"></i></a>
      <div id="modalCreateUser" class="modal fade">
        <div class="modal-dialog modal-dialog-vertical-center" role="document">
          <form action="/manage/user" method="POST" class="modal-content bd-0 tx-14">
            @csrf
            <div class="modal-header pd-y-20 pd-x-25">
              <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Tambah Data Pengguna</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body pd-25">
              <div class="form-group">
                <label class="form-control-label">Nama: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="name" placeholder="Masukkan nama" required>
              </div>
              <div class="form-group">
                <label class="form-control-label">Alamat: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="address" placeholder="Masukkan alamat" required>
              </div>
              <div class="form-group">
                <label class="form-control-label">No HP: <span class="tx-danger">*</span></label>
                <input class="form-control" type="number" name="phone_number" placeholder="Masukkan ho hp" required>
              </div>
              <div class="form-group">
                <label class="form-control-label">No SIM: <span class="tx-danger">*</span></label>
                <input class="form-control" type="number" name="sim_number" placeholder="Masukkan ho sim" required>
              </div>
              <div class="form-group">
                <label class="form-control-label">Username: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="username" placeholder="Masukkan username" required>
              </div>
              <div class="form-group">
                <label class="form-control-label">Password: <span class="tx-danger">*</span></label>
                <input class="form-control" type="password" name="password" placeholder="Masukkan password" required>
              </div>
              <div class="form-group">
                <label class="form-control-label">Peran: <span class="tx-danger">*</span></label>
                <select class="form-control" name="role" required>
                  <option value="Pelanggan">Pelanggan</option>
                  <option value="Admin">Admin</option>
                </select>
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
                <th class="wd-20p">Nama</th>
                <th class="wd-20p">No HP</th>
                <th class="wd-20p">No SIM (UNIQUE)</th>
                <th class="wd-20p">Username (UNIQUE)</th>
                <th class="wd-10p">Role</th>
                <th class="wd-15p text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $dataUser)
                <tr>
                  <td class="text-center">{{ $loop->iteration }}</td>
                  <td>{{ $dataUser->name }}</td>
                  <td>{{ $dataUser->phone_number }}</td>
                  <td>{{ $dataUser->sim_number }}</td>
                  <td>{{ $dataUser->username }}</td>
                  <td>{{ $dataUser->role }}</td>
                  <td>
                    <div class="d-flex justify-content-center">
                      {{-- Tombol Modal Update --}}
                      <a href="" class="btn btn-warning tx-10 pd-x-10 pd-y-5 mr-2" data-toggle="modal" data-target="#modalUpdateUser{{ $dataUser->id }}"><i class="bi bi-pen mr-1"></i> Edit</a>
                      <div data-kode="{{ $dataUser->id }}" class="btn btn-danger tx-10 pd-x-10 pd-y-5 swal-confirm">
                        <form action="/manage/user/{{ $dataUser->id }}" id="delete{{ $dataUser->id }}" method="post">
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
        
        @foreach ($data as $dataUser)
          {{-- Modal Update --}}
          <div id="modalUpdateUser{{ $dataUser->id }}" class="modal fade">
            <div class="modal-dialog modal-dialog-vertical-center" role="document">
              <form action="/manage/user/{{ $dataUser->id }}" method="POST" class="modal-content bd-0 tx-14">
                @csrf
                @method('put')
                <div class="modal-header pd-y-20 pd-x-25">
                  <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Update Data Pengguna</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body pd-25">
                  <div class="form-group">
                    <label class="form-control-label">Nama: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="name" placeholder="Masukkan nama" required value="{{ $dataUser->name }}">
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Alamat: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="address" placeholder="Masukkan alamat" required value="{{ $dataUser->address }}">
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">No HP: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="number" name="phone_number" placeholder="Masukkan ho hp" required value="{{ $dataUser->phone_number }}">
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">No SIM: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="number" name="sim_number" placeholder="Masukkan ho sim" required value="{{ $dataUser->sim_number }}">
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Username: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="username" placeholder="Masukkan username" required value="{{ $dataUser->username }}">
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Peran: <span class="tx-danger">*</span></label>
                    <select class="form-control" name="role" required>
                      <option value="{{ $dataUser->role }}">{{ $dataUser->role }}</option>
                      <option value="Pelanggan">Pelanggan</option>
                      <option value="Admin">Admin</option>
                    </select>
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