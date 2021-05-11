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
								          <th>address</th>
								          {{-- <th>private_key</th> --}}
								          <th>status</th>
                                          <th>provider_id</th>
                                          <th>provider_name</th>
                                          <th>Created at</th>
								        </tr>
							      	</thead>
							      	<tbody>
								        @if(count($wallets) == 0)
								          <tr>
								            <td colspan="5" style="padding: 20px;">No results for your search.</td>
								          </tr>
								        @else
								          @foreach($wallets as $wallet)
								          <tr>
								            <td>{{ $wallet->id }}</td>
								            <td>{{ $wallet->user_id}}</td>
								            <td>{{ $wallet->address}}</td>
								            {{-- <td>{{ $wallet->private_key}}</td> --}}
								            <td>{{ $wallet->status}}</td>
								            <td>{{ $wallet->provider_id}}</td>
								            <td>{{ $wallet->provider_name}}</td>
								            <td>{{ $wallet->created_at }}</td>
								          </tr>
								          @endforeach
								        @endif
							      	</tbody>
                                </table>

                            </div>

                        </div>
            		</div>
            	</div>
            </div>

@endsection
