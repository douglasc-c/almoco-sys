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
            			<div class="header">
            				<div class="row" style="width: 100%;">
							    <div class="col-md-4"><h2><strong>Manage</strong> Users</h2></div>
							    {{-- @if($query != null)
							    <div class="col-md-4" style="text-align: right;">
							      <form  action="/admin/users" method="get">
							        <div class="">
							          <input type="hidden" name="query" class="form-control" placeholder="Search... " value="">
							          <div >
							            <button class="btn btn-dark text-white" type="submit"> Clear all filters </button>
							          </div>
							        </div>
							      </form>
							    </div>
							    @else
							      <div class="col-md-4"></div>
							    @endif
							    <div class="col-md-4">
							      <form  action="/admin/users" method="get">
							        <div class="input-group mb-3">
							          <input type="text" name="query" class="form-control" placeholder="Search by Email... " value="{{ $query }}">
							          <div class="input-group-prepend">
							            <button class="btn btn-primary" type="submit"> <i class="zmdi zmdi-search"></i> </button>
							          </div>
							        </div>
							      </form>

							    </div> --}}
							</div>
                        </div>
                        <div class="card-body">

                        	<div class="table-responsive">
                                <table class="table table-hover m-b-0 table-striped table-bordered">
                                    <thead>
								        <tr>
								          <th>#</th>
								          <th>Reffer Code</th>
								          <th>Name</th>
								          <th>E-mail</th>
								          <th>Created at</th>
								          <th>Doc. Validated</th>
								          <th>Actions</th>
								        </tr>
							      	</thead>
							      	<tbody>
								        @if(count($users) == 0)
								          <tr>
								            <td colspan="5" style="padding: 20px;">No results for your search.</td>
								          </tr>
								        @else
								          @foreach($users as $user)
								          @if($user->hasRole('user'))
								          <tr>
								            <td>{{ $user->id }}</td>
											<td>{{ $user->code }}</td>
								            <td>{{ $user->name }}</td>
								            <td>{{ $user->email }}</td>
								            <td>{{ $user->created_at }}</td>
								            <td>
								            	@if($user->validated == 1)
								            	<span class="badge badge-success">Verified</span>
								            	@else
								            	<span class="badge badge-danger">Unverified</span>
								            	@endif
								            </td>
								            <td>
								            	@if(Auth::user()->hasRole('adminCanActionUsers'))
								              		<a href="{{URL::action('Admin\UsersController@edit', $user->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">Edit</i> </a>
								              	@endif
								              	<!-- <a href="{{URL::action('Admin\UsersController@getUserWallets', $user->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Wallets">Wallets</a> -->
								              	<a href="{{URL::action('Admin\UsersController@accessUser', $user->id)}}" class="btn btn-sm btn-info text-white" data-toggle="tooltip" title="Wallets">Access</a>
								            </td>
								          </tr>
								          @endif
								          @endforeach
								        @endif
							      	</tbody>
                                </table>
                                <span style="margin: 0 auto;">{{ $users->links() }}</span>
                            </div>

                        </div>
            		</div>
            	</div>
            </div>

@endsection
