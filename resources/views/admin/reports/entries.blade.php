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
			    <div class="col">
			      <div class="card m-b-30 ">
			        <div class="card-body text-center">
			          <strong class="d-block">
			            Total Today
			          </strong>
			          <span class="d-block">{{bcdiv($total['today'], 1, 2)}}</span>
			        </div>
			      </div>
			    </div>
			    <div class="col">
			      <div class="card m-b-30 ">
			        <div class="card-body text-center">
			          <strong class="d-block">
			            Total Month
			          </strong>
			          <span class="d-block">{{bcdiv($total['month'], 1, 2)}}</span>
			        </div>
			      </div>
			    </div>
			    <div class="col">
			      <div class="card m-b-30 ">
			        <div class="card-body text-center">
			          <strong class="d-block">
			            Total All
			          </strong>
			          <span class="d-block">{{bcdiv($total['all'], 1, 2)}}</span>
			        </div>
			      </div>
			    </div>
			    <div class="col">
			      <div class="card m-b-30 ">
			        <div class="card-body text-center">
			          <strong class="d-block">
			            Master Balance
			          </strong>
			          <span class="d-block">{{bcdiv($wallet['balance'], 1, 2)}}</span>
			        </div>
			      </div>
			    </div>
			    @if($type_name == 'default')
			    <div class="col">
			      <div class="card m-b-30 bg-warning">
			        <div class="card-body text-center">
			          <strong class="d-block">
			            Pending to Master
			          </strong>
			          <span class="d-block">{{bcdiv($total['pending_master'], 1, 2)}}</span>
			        </div>
			      </div>
			    </div>
			    @endif
		  	</div>

			<div class="row">
            	<div class="col-md-12">
            		<div class="card">
                        <div class="">

                        	<div class="table-responsive">
                                <table class="table table-hover m-b-0 table-striped table-bordered">
                                    <thead>
								        <tr>
								          <th>#</th>
								          <th>User</th>
								          <th>Created at</th>
								          <th>Amount</th>
								          <th>
								          	@if($type_name == 'stake')
								          	Method
								          	@else
								          	Hash
								          	@endif
								          </th>
								          @if($type_name == 'default')
								          <th>Master</th>
								          @endif
								        </tr>
							      	</thead>
							      	<tbody>
								        @if(count($orders) == 0)
								          <tr>
								            <td colspan="12" style="padding: 20px;">No results for your search.</td>
								          </tr>
								        @else
								          @foreach($orders as $order)
								          	@if($type_name == 'stake')
								          	<tr>
									            <td>{{ $order->id }}</td>
									            <td>
									            	{{ $order->user->email }}
									            	@if(Auth::user()->hasRole('adminCanActionUsers'))
														<a href="{{URL::action('Admin\UsersController@edit', $order->user->id)}}">({{ $order->user->code }})</a>
													@else
														({{ $order->user->code }})
													@endif
									            </td>
									            <td>{{ $order->paid_at }}</td>
									            <td><span class="">{{ bcdiv($order->total, 1, 2) }} NVA</span></td>
									            <td>Wallet Default</td>
								          	</tr>
								          	@else
								          	<tr>
									            <td>{{ $order->id }}</td>
									            <td>
									            	{{ $order->user->email }}
									            	@if(Auth::user()->hasRole('adminCanActionUsers'))
														<a href="{{URL::action('Admin\UsersController@edit', $order->user->id)}}">({{ $order->user->code }})</a>
													@else
														({{ $order->user->code }})
													@endif
									            </td>
									            <td>{{ $order->created_at }}</td>
									            <td><span class="">{{ bcdiv($order->amount, 1, 2) }} NVA</span></td>
									            <td><a href="https://etherscan.io/tx/{{ $order->input_hash }}" target="_blank">{{ substr($order->input_hash, 0, 20) }}...</a></a></td>
									            <td>
									            	@if($order->master_send)
									            	<span class="badge badge-success">Yes</span>
									            	@else
									            	<span class="badge badge-danger">No</span>
									            	@endif
									            </td>
								          	</tr>
								          	@endif
								          @endforeach
								        @endif
							      	</tbody>
                                </table>
                                <span style="margin: 0 auto;">{{ $orders->links() }}</span>
                            </div>

                        </div>
            		</div>
            	</div>
            </div>

@endsection
