@php
$twofaActived = App\G2FA::where('user_id', $user->id)->first();
@endphp
<a href="{{URL::action('Admin\UsersController@accessAsUser', $user->id)}}" class="btn btn-xs btn-primary" style="min-width: 100px; min-height: 46x;"><i class="fa fa-arrow-right"></i> Access</a>
{{-- <a href="{{URL::action('Admin\UsersController@accessAsUser', $user->id)}}" class="btn btn-xs btn-secondary"><i class="fa fa-arrow-right"></i> Edit</a> --}}
<button type="button" class="btn btn-xs btn-secondary" data-toggle="modal" data-target="#editUser_{{$user->id}}" style="min-width: 100px;min-height: 46px;">Edit</button>
@if($twofaActived)
<a href="{{URL::action('Admin\UsersController@disableTwofa', $user->id)}}" class="btn btn-xs btn-danger" style="min-width: 100px; min-height: 46x;"><i class="fa fa-arrow-right"></i> Disable 2FA</a>
@endif 

<div class="modal fade" id="editUser_{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content radius-30">
            <div class="modal-header border-bottom-0">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body p-5">
              <form method="POST" action="{{URL::action('Admin\UsersController@updateProfile', $user->id)}}">
                  {{ csrf_field() }}
                <h3 class="text-center">Update User</h3>
                <div class="form-group">
                  <label>Name</label>
                <input type="text" name="name" class="form-control form-control-lg radius-30" value="{{$user->name}}"/>
                </div>
                <div class="form-group">
                  <label>UserName</label>
                <input type="text" name="username" class="form-control form-control-lg radius-30" value="{{$user->username}}"/>
                </div>
                <div class="form-group">
                  <label>Phone</label>
                <input type="number" name="phone" class="form-control form-control-lg radius-30" value="{{$user->phone}}"/>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" name="email" class="form-control form-control-lg radius-30" value="{{$user->email}}"/>
                </div>
                <div class="form-group col-md-12">
                    <label>New password</label>
                    <input type="password" placeholder="****" class="form-control" name="password" >
                </div>
                <div class="form-group col-md-12">
                    <label>Confirm password</label>
                    <input type="password" placeholder="****" class="form-control" name="password_confirmation" >
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-light radius-30 btn-lg btn-block">Update</button>
                </div>
                <hr/>
              </form>
            </div>
          </div>
        </div>
</div>