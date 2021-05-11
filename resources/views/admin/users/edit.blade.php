@extends('admin.layouts.default')

@section('title')
{{$title}} -
@parent
@stop

@section('content')
<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Heading-->
            <div class="d-flex flex-column">
                <!--begin::Title-->
                <h2 class="text-white font-weight-bold my-2 mr-5">{{$title}}</h2>
            </div>
            <!--end::Heading-->
        </div>
        <!--end::Info-->
    </div>
</div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-md-6">
              <span style="float: left;" class="btn btn-primary disabled">Type: {{ $user->hasRole('admin') ? "Admin" : "User"}} - {{$title}}</span>
              <span style="float: left;" class="btn btn-primary disabled ml-3">Last IP access: {{$user->last_ip}}</span>
            </div>
            <div class="col-md-6">
              @if(!$user->email_verified_at)
                <a href="{{URL::action('Admin\UsersController@confirmEmail', $user->id)}}" style="float:right" class="btn btn-warning mb-3 ml-1">Confirm E-mail Manual</a>
              @endif

              @if($user->google2fa_secret)
                <a href="{{URL::action('Admin\UsersController@disable2fa', $user->id)}}" style="float:right" class="btn btn-warning mb-3 mr-2">Disable 2FA</a>
              @endif

              @if(!$user->blocked)
                <a href="{{URL::action('Admin\UsersController@definetBlock', [$user->id, 1])}}" style="float:right" class="btn btn-danger mb-3 mr-2">Block User</a>
              @else
                <a href="{{URL::action('Admin\UsersController@definetBlock', [$user->id, 0])}}" style="float:right" class="btn btn-success mb-3 mr-2">Unblock User</a>
              @endif
            </div>
          </div>

          <form method="POST" action="{{URL::action('Admin\UsersController@updateUserInfo', $user->id)}}" class="mt-3">

            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Name</label>
                  <input name="name" type="text" class="form-control" value="{{ $user->name }}">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Email address</label>
                  <input name="email" type="email" class="form-control" value="{{ $user->email }}">
                </div>
              </div>
              {{-- <div class="col-md-4">
                <div class="form-group">
                  <label>Sponsor</label>
                  <input name="sponsor" type="text" class="form-control" value="{{(($user->sponsor) ? App\User::find($user->sponsor)->code : '')}}">
                </div>
              </div> --}}
            </div>

            <div class="row">
              {{-- <div class="col-md-4">
                <div class="form-group">
                  <label>Can Receive Bonus (Staking Indication)</label><br />

                  <input type="radio" id="bonus_reffer_yes" name="bonus_reffer" value="1" @if($user->bonus_reffer == 1) checked @endif>
                  <label for="bonus_reffer_yes">Yes</label>

                  <input type="radio" id="bonus_reffer_no" name="bonus_reffer" value="0" @if($user->bonus_reffer == 0) checked @endif>
                  <label for="bonus_reffer_no">No</label>
                </div>
              </div> --}}
              <div class="col-md-4">
                <div class="form-group">
                  <label>Password</label>
                  <input name="password" type="password" class="form-control" placeholder="Leave it blank if you don't want to change user's password.">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Confirm Password</label>
                  <input name="password_confirmation" type="password" class="form-control" placeholder="Leave it blank if you don't want to change user's password.">
                </div>
              </div>
            </div>

            @if(Auth::user()->hasRole('superadmin'))
              @if(!$user->hasRole('admin'))
              <div class="form-group">
                <div class="alert alert-dismissible alert-warning"><strong>Warning!</strong> Be careful, only check this field if you are sure of what you're doing.</div>
                <div class="custom-control custom-checkbox">
                  <input name="makeAdmin" type="checkbox" class="custom-control-input" id="customCheck1">
                  <label class="custom-control-label" for="customCheck1">Make this user Admin</label>
                </div>
              </div>
              @endif
            @endif

            {{-- @if(Auth::user()->hasRole('adminCanActionUsers')) --}}
            <div class="mb-3" style="float: right;">
              <a href="/admin/users" class="btn btn-dark text-white">Back</a>
              <button type="submit" class="btn btn-success text-white">Submit</button>
            </div>
            {{-- @endif --}}

          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
