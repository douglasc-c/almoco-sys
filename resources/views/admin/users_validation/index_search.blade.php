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
                        <div class="">
                        	<div class="header">
	            				<div class="row" style="width: 100%;">
								    <div class="col-md-4"><h2><strong>Manage</strong> Users</h2></div>
								    {{-- @if($query != null)
								    <div class="col-md-4" style="text-align: right;">
								      <form  action="/admin/users-validations-search" method="get">
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
								      <form  action="/admin/users-validations-search" method="get">
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
                        	<div class="table-responsive">
                                <table class="table table-hover m-b-0 table-striped table-bordered">
                                    <thead>
								        <tr>
								          <th>#</th>
								          <th>User</th>
								          <th>Email</th>
								          <th>Fullname</th>
								          <th>Document</th>
								          <th>Birthday</th>
								          <th>Archive</th>
								          <th>Status</th>
								          <th>Date</th>
								          <th></th>
								        </tr>
							      	</thead>
							      	<tbody>
								        @if(count($validations) == 0)
								          <tr>
								            <td colspan="5" style="padding: 20px;">No results for your search.</td>
								          </tr>
								        @else
								          @foreach($validations as $validation)
								          <tr>
								            <td>{{ $validation->id }}</td>
											<td>{{ $validation->user->code }}</td>
								            <td>{{ $validation->user->email }}</td>
								            <td>{{ $validation->fullname }}</td>
								            <td>{{ $validation->doc_type }} | {{ $validation->doc_number }}</td>
								            <td>{{ $validation->birthday }}</td>
								            <td>
								            	<button type="button" class="btn btn-info btn-sm text-white" data-toggle="modal" data-target="#modalArchive-{{$validation->token}}">Open</button>


												<div id="modalArchive-{{$validation->token}}" class="modal fade" role="dialog" style="background: rgb(28 19 167 / 0.5);">
												  <div class="modal-dialog modal-lg modal-dialog-centered">

												    <!-- Modal content-->
												    <div class="modal-content">
												      <div class="modal-header">
												      	<h5 class="modal-title">Archive - {{$validation->token}}</h5>
												        <button type="button" class="close" data-dismiss="modal">&times;</button>
												      </div>
												      <div class="modal-body">
												        <img src="{{$validation->document_url}}" style="max-width: 100%;border: 1px solid #dee2e6;border-radius: 5px;">
												      </div>
												    </div>

												  </div>
												</div>
								            </td>
								            <td>
								            	@if($validation->status == 1)
								            	<span class="badge badge-success">Validated</span>
								            	@elseif($validation->status == 2)
								            	<span class="badge badge-danger">Decline</span>
								            	@else
								            	<span class="badge badge-warning">Pending</span>
								            	@endif
								            </td>
								            <td>{{ $validation->created_at }}</td>
								            <td>
								            	@if($validation->status == 0)
									            	@if(Auth::user()->hasRole('adminCanActionVerifications'))
									            	<a href="#modal-dialog" data-toggle="modal" data-href="{{URL::action('Admin\UserValidationController@approve', $validation->id)}}" class="btn btn-sm btn-success text-white">Approve</a>

									            	<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalDecline-{{$validation->token}}">Decline</button>

									            	<div id="modalDecline-{{$validation->token}}" class="modal fade" role="dialog" style="background: rgb(28 19 167 / 0.5);">
													  <div class="modal-dialog modal-dialog-centered">

													    <!-- Modal content-->
													    <div class="modal-content">
													      <div class="modal-header">
													      	<h5 class="modal-title">Decline - {{$validation->token}}</h5>
													        <button type="button" class="close" data-dismiss="modal">&times;</button>
													      </div>
													      <div class="modal-body">
													      	<form method="POST" action="{{URL::action('Admin\UserValidationController@decline', $validation->id)}}">
													      		<input type="hidden" name="_token" value="{{ csrf_token() }}">

													      		<textarea rows="4" class="form-control no-resize" name="decline_motive" required="" placeholder="Describe the motive about decline.."></textarea>

													      		<button type="submit" class="btn btn-success text-white mt-4 btn-block">Decline</button>

													      	</form>
													      </div>
													    </div>

													  </div>
													</div>
													@endif

								              	@endif
								            </td>
								          </tr>
								          @endforeach
								        @endif
							      	</tbody>
                                </table>
                                <span style="margin: 0 auto;">{{ $validations->links() }}</span>
                            </div>

                        </div>
            		</div>
            	</div>
            </div>

@endsection

@section('styles')
<style type="text/css">
.modal-backdrop{
    display: none;
}
</style>
@stop
