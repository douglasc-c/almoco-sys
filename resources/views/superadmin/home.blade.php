@extends('superadmin.layouts.default')

@section('title')
Home -
@parent
@stop

@section('content')

  <div class="row mb-4">
    <div class="col-12 d-flex align-items-center justify-content-between">
      <h4 class="page-title">Dashboard super admin</h4>
      <div class="d-flex align-items-center">
        <div class="wrapper mr-0 d-none d-sm-block">
          <p class="mb-0">Summary for
            <b class="mb-0">{{date("F j, Y")}}</b>
          </p>
        </div>
      </div>
    </div>
  </div>

@endsection
