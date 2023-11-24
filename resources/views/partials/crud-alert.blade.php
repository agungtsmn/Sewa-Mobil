<div class="pd-t-30 pd-x-20 pd-sm-x-30">
  @if (session()->has('success'))
    <div class="alert alert-success" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="d-flex align-items-center justify-content-start">
        <i class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
        <span><strong>Mantap!</strong> {{ session('success') }}</span>
      </div><!-- d-flex -->
    </div><!-- alert -->
  @endif
  @if (session()->has('update'))
    <div class="alert alert-warning" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="d-flex align-items-center justify-content-start">
        <i class="icon ion-alert-circled alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
        <span><strong>Huh!</strong> {{ session('update') }}</span>
      </div><!-- d-flex -->
    </div><!-- alert -->
  @endif
  @if (session()->has('delete'))
    <div class="alert alert-danger" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="d-flex align-items-center justify-content-start">
        <i class="icon ion-ios-close alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
        <span><strong>Waduh!</strong> {{ session('delete') }}</span>
      </div><!-- d-flex -->
    </div><!-- alert -->
  @endif
</div>