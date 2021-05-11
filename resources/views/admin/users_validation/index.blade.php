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
								          <th>Archive Front</th>
								          <th>Archive Verse</th>
								          <th>Status</th>
								          <th>Date</th>
								          <th>Country</th>
								          <th>City</th>
								          <th>Address</th>
								          <th>Archive Address</th>
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
								            <!-- FRONT DOCUMENT START -->
								            <td>
								            	<button type="button" class="btn btn-info btn-sm text-white" data-toggle="modal" data-target="#modalArchiveFront-{{$validation->token}}">Open</button>


												<div id="modalArchiveFront-{{$validation->token}}" class="modal fade" role="dialog" style="background: rgb(28 19 167 / 0.5);">
												  <div class="modal-dialog modal-lg modal-dialog-centered">

												    <!-- Modal content-->
												    <div class="modal-content">
												      <div class="modal-header">
												      	<h5 class="modal-title">Archive - {{$validation->token}}</h5>
												        <button type="button" class="close" data-dismiss="modal">&times;</button>
												      </div>
												      <div class="modal-body">
												        <img src="{{$validation->document_front}}" style="max-width: 100%;border: 1px solid #dee2e6;border-radius: 5px;">
												      </div>
												    </div>

												  </div>
												</div>
								            </td>
								            <!-- FRONT DOCUMENT END -->
								            <!-- VERSE DOCUMENT START -->
								            <td>
								            	<button type="button" class="btn btn-info btn-sm text-white" data-toggle="modal" data-target="#modalArchiveVerse-{{$validation->token}}">Open</button>


												<div id="modalArchiveVerse-{{$validation->token}}" class="modal fade" role="dialog" style="background: rgb(28 19 167 / 0.5);">
												  <div class="modal-dialog modal-lg modal-dialog-centered">

												    <!-- Modal content-->
												    <div class="modal-content">
												      <div class="modal-header">
												      	<h5 class="modal-title">Archive - {{$validation->token}}</h5>
												        <button type="button" class="close" data-dismiss="modal">&times;</button>
												      </div>
												      <div class="modal-body">
												        <img src="{{$validation->document_verse}}" style="max-width: 100%;border: 1px solid #dee2e6;border-radius: 5px;">
												      </div>
												    </div>

												  </div>
												</div>
								            </td>
								            <!-- VERSE DOCUMENT END -->

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
								            <td>{{ $validation->residence_country }}</td>
								            <td>{{ $validation->residence_city }}</td>
								            <td>{{ $validation->residence_street }}</td>

								            <td>
								            	<button type="button" class="btn btn-info btn-sm text-white" data-toggle="modal" data-target="#modalArchiveAddress-{{$validation->token}}">Open</button>


												<div id="modalArchiveAddress-{{$validation->token}}" class="modal fade" role="dialog" style="background: rgb(28 19 167 / 0.5);">
												  <div class="modal-dialog modal-lg modal-dialog-centered">

												    <!-- Modal content-->
												    <div class="modal-content">
												      <div class="modal-header">
												      	<h5 class="modal-title">Archive Address - {{$validation->token}}</h5>
												        <button type="button" class="close" data-dismiss="modal">&times;</button>
												      </div>
												      <div class="modal-body">
												        <img src="{{$validation->residence_url}}" style="max-width: 100%;border: 1px solid #dee2e6;border-radius: 5px;">
												      </div>
												    </div>

												  </div>
												</div>
								            </td>
								            <td>
								            	@if($validation->status == 0)
									            	<a href="{{URL::action('Admin\UserValidationController@approve', $validation->id)}}" class="btn btn-sm btn-success text-white">Approve</a>

									            	<button type="button" class="btn btn-sm btn-danger mt-2" data-toggle="modal" data-target="#modalDecline-{{$validation->token}}">Decline</button>

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
