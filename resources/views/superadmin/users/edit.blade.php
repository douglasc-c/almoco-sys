@extends('admin.layouts.default')

@section('title')
Edit User -
@parent
@stop

@section('content')

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">

        <div>
          <div class="d-sm-flex">
            <div class="w w-auto-xs light bg bg-auto-sm b-r">
              <div class="py-3">
                <div class="nav-active-border left b-primary">
                  <ul class="nav flex-column nav-sm">
                    <li class="nav-item">
                      <a class="nav-link active" href="#" data-toggle="tab" data-target="#profile">Profile</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link " href="#" data-toggle="tab" data-target="#security">Security</a>
                    </li>
                     <li class="nav-item">
                      <a class="nav-link " href="#" data-toggle="tab" data-target="#unilevel">Unilevel</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link " href="#" data-toggle="tab" data-target="#logs">Logs</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col p-0">
              <div class="tab-content pos-rlt">
                <div class="tab-pane active" id="profile">
                  <div class="p-4 b-b _600">Profile</div>
                  {{-- <form role="form" class="p-4 col-md-6" method="POST" action="{{URL::action('Admin\UsersController@updateProfile', $user->id)}}"> --}}
                    @include('partials.flash-messages-auth')
                      @include('partials.error-block')
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label>Fullname</label>
                      <input type="text" class="form-control" name="name" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" class="form-control" name="username" value="{{$user->username}}">
                    </div>
                    <div class="form-group">
                      <label>E-mail</label>
                      <input type="text" class="form-control" name="email" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                      <label>Phone</label>
                      <input type="text" class="form-control" name="phone" value="{{$user->phone}}">
                    </div>
                    <button type="submit" class="btn btn-warning mt-2">Update</button>
                  {{-- </form> --}}
                </div>
                <div class="tab-pane" id="security">
                  <div class="p-4 b-b _600">Security</div>
                  <div class="p-4">
                    <div class="clearfix">
                      <form role="form" method="post" action="{{URL::action('Admin\UsersController@updateSecurity', $user->id)}}" class="col-md-6 p-0">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label>New Password</label>
                          <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group">
                          <label>New Password Again</label>
                          <input type="password" class="form-control" name="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-warning mt-2">Update</button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="logs">
                  <div class="p-4 b-b _600">Logs actions</div>
                  <div class="p-4 col-md-6">
                    <div class="streamline">
                      @if($user->log()->count() > 0)
                      @foreach($user->log()->orderBy('created_at', 'DESC')->get() as $log)
                        <div class="sl-item b-{{$log->typeColor()}}">
                          <div class="sl-content">
                            <div class="sl-date text-muted">{{$log->created_at->diffForHumans()}}</div>
                            <p>{{$log->description}}</p>
                          </div>
                        </div>
                      @endforeach
                      @else
                      <div class="alert alert-info">
                          This user not have saved logs yet. In here you can check all logs of user.
                        </div>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="tab-pane" id="unilevel">
                  <div class="p-4 b-b _600">Unilevel</div>
                  <div class="p-4 col-md-6">
                    <div class="streamline">
                        <form role="form" method="post" action="{{URL::action('Admin\UsersController@updateUnilevel', $user->id)}}" class="col-md-6 p-0">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label>Levels Unlocked</label>
                          <input type="text" class="form-control" name="level" value="{{$data->level_avaiable}}">
                        </div>
                        <button type="submit" class="btn btn-warning mt-2">Update</button>
                      </form>



                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>


@endsection