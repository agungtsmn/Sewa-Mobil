<!-- ########## START: LEFT PANEL ########## -->
<div class="br-logo"><a href=""><span>[</span>Sewa Mobil<span>]</span></a></div>
<div class="br-sideleft overflow-y-auto">
  <label class="sidebar-label pd-x-15 mg-t-20">Navigation</label>
  <div class="br-sideleft-menu">

    <a href="/" class="br-menu-link {{ Request::is('/') ? 'active' : '' }}">
      <div class="br-menu-item">
        <i class="menu-item-icon bi bi-columns-gap tx-18"></i>
        <span class="menu-item-label">Home</span>
      </div><!-- menu-item -->
    </a><!-- br-menu-link -->

    @if (Auth::user()) 
      @if (Auth::user()->role == 'Pelanggan')

        <a href="/page/booking" class="br-menu-link {{ Request::is('page/booking') ? 'active' : '' }}">
          <div class="br-menu-item">
            <i class="menu-item-icon bi bi-bookmark tx-18"></i>
            <span class="menu-item-label">My Rent</span>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->

      @endif

      @if (Auth::user()->role == 'Admin')
        <a href="/manage/user" class="br-menu-link {{ Request::is('manage/*') ? 'show-sub active' : '' }}">
          <div class="br-menu-item">
            <i class="menu-item-icon bi bi-kanban tx-18"></i>
            <span class="menu-item-label">Kelola Data</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub nav flex-column">
          <li class="nav-item"><a href="/manage/user" class="nav-link {{ Request::is('manage/user') || Request::is('manage/user/*') ? 'active' : '' }}">Pengguna</a></li>
          <li class="nav-item"><a href="/manage/car" class="nav-link {{ Request::is('manage/car') || Request::is('manage/car/*') ? 'active' : '' }}">Mobil</a></li>
          {{-- <li class="nav-item"><a href="/manage/carbooking" class="nav-link {{ Request::is('manage/carbooking') || Request::is('manage/carbooking/*') ? 'active' : '' }}">Pemesanan</a></li> --}}
          {{-- <li class="nav-item"><a href="/manage/carreturn" class="nav-link {{ Request::is('manage/carreturn') || Request::is('manage/carreturn/*') ? 'active' : '' }}">Pengembalian</a></li> --}}
        </ul>
      @endif
    @endif

  </div><!-- br-sideleft-menu -->

  <label class="sidebar-label pd-x-15 mg-t-25 mg-b-20 tx-info op-9">Information Summary</label>

  <div class="info-list">
    <div class="d-flex align-items-center justify-content-between pd-x-15">
      <div>
        <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">Memory Usage</p>
        <h5 class="tx-lato tx-white tx-normal mg-b-0">32.3%</h5>
      </div>
      <span class="peity-bar" data-peity='{ "fill": ["#336490"], "height": 35, "width": 60 }'>8,6,5,9,8,4,9,3,5,9</span>
    </div><!-- d-flex -->

    <div class="d-flex align-items-center justify-content-between pd-x-15 mg-t-20">
      <div>
        <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">CPU Usage</p>
        <h5 class="tx-lato tx-white tx-normal mg-b-0">140.05</h5>
      </div>
      <span class="peity-bar" data-peity='{ "fill": ["#1C7973"], "height": 35, "width": 60 }'>4,3,5,7,12,10,4,5,11,7</span>
    </div><!-- d-flex -->

    <div class="d-flex align-items-center justify-content-between pd-x-15 mg-t-20">
      <div>
        <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">Disk Usage</p>
        <h5 class="tx-lato tx-white tx-normal mg-b-0">82.02%</h5>
      </div>
      <span class="peity-bar"
        data-peity='{ "fill": ["#8E4246"], "height": 35, "width": 60 }'>1,2,1,3,2,10,4,12,7</span>
    </div><!-- d-flex -->

    <div class="d-flex align-items-center justify-content-between pd-x-15 mg-t-20">
      <div>
        <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">Daily Traffic</p>
        <h5 class="tx-lato tx-white tx-normal mg-b-0">62,201</h5>
      </div>
      <span class="peity-bar"
        data-peity='{ "fill": ["#9C7846"], "height": 35, "width": 60 }'>3,12,7,9,2,3,4,5,2</span>
    </div><!-- d-flex -->
  </div><!-- info-lst -->

  <br>
</div><!-- br-sideleft -->
<!-- ########## END: LEFT PANEL ########## -->