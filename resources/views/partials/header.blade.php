<!-- ########## START: HEAD PANEL ########## -->
<div class="br-header">
  <div class="br-header-left">
    <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
    <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>

  </div><!-- br-header-left -->
  <div class="br-header-right">

    <nav class="nav">
      @if (!Auth::user())
        <div class="d-flex">
          <a href="/page/login" class="btn btn-primary text-white w-100 mg-r-10 pd-x-20">Login</a>
          <a href="/page/register" class="btn btn-secondary text-white w-100 mg-r-30 pd-x-20">Register</a>
        </div>
      @else
        <div class="dropdown">
          <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
            <span class="logged-name hidden-md-down">{{ Auth::user()->name }}</span>
            <img src="http://via.placeholder.com/64x64" class="wd-32 rounded-circle" alt="">
            <span class="square-10 bg-success"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-header wd-200">
            <ul class="list-unstyled user-profile-nav">
              <li><a href="/logout"><i class="icon bi bi-power"></i> Sign Out</a></li>
            </ul>
          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
      @endif
    </nav>

  </div><!-- br-header-right -->
</div><!-- br-header -->
<!-- ########## END: HEAD PANEL ########## -->