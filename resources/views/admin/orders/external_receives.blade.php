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
			    <div class="col-md-4">
			      <div class="card m-b-30 ">
			        <div class="card-body text-center">
			          <strong class="d-block">
			            Total Pending
			          </strong>
			          <span class="d-block">{{bcdiv($total['pending'], 1, 2)}}</span>
			        </div>
			      </div>
			    </div>
			    <div class="col-md-4">
			      <div class="card m-b-30 ">
			        <div class="card-body text-center">
			          <strong class="d-block">
			            Total Complete
			          </strong>
			          <span class="d-block">{{bcdiv($total['complete'], 1, 2)}}</span>
			        </div>
			      </div>
			    </div>
			    <div class="col-md-4">
			      <div class="card m-b-30 ">
			        <div class="card-body text-center">
			          <strong class="d-block">
			            Wallet Fee Balance <b>{{bcdiv($walletFee['balance'],1,2)}} ETH</b>
			            @if($walletFee['need_recharge'])
			            | <span class="badge badge-danger">Need Recharge</span>
			            @endif
			          </strong>
			          <span class="d-block"> <a href="https://etherscan.io/address/{{$walletFee['address']}}" target="_blank">{{$walletFee['address']}}</a>
			          </span>
			        </div>
			      </div>
			    </div>
		  	</div>

		  	<div class="row mb-4">
			    <div class="col-md-12">
			      <div class="btn-group justify-content-between" role="group" aria-label="Change Status" style="width: 100%;">
			        <a href="{{URL::action('Admin\OrdersController@externalReceives', [$payment_method])}}" class="btn btn-dark {{(Request::url() == URL::action('Admin\OrdersController@externalReceives', [$payment_method])) ? 'active' : ''}}">All</a>
			        <a href="{{URL::action('Admin\OrdersController@externalReceives', [$payment_method, 0])}}" class="btn btn-warning text-white {{(Request::url() == URL::action('Admin\OrdersController@externalReceives', [$payment_method, 0])) ? 'active' : ''}}">Pending</a>
			        <a href="{{URL::action('Admin\OrdersController@externalReceives', [$payment_method, 1])}}" class="btn btn-success text-white {{(Request::url() == URL::action('Admin\OrdersController@externalReceives', [$payment_method, 1])) ? 'active' : ''}}">Complete</a>
			      </div>
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
								          <th>ID</th>
						                  <th>Order ID</th>
						                  <th>Address</th>
						                  <th>Forward</th>
						                  <th>Created at</th>
						                  <th>Amount</th>
								        </tr>
							      	</thead>
							      	<tbody>
							          @foreach($payments as $payment)
							          <tr>
							            <td>{{ $payment->id }}</td>
							            <td>{{ $payment->order_id }}</td>
							            <td>{{ $payment->address }}</td>
							            <td>
							            	@if($payment->forward == 1)
								                <span class="badge badge-success">Complete</span>
								            @else
								            	<span class="badge badge-warning">Pending</span>
								            @endif
							            </td>
							            <td>{{ $payment->created_at }}</td>
							            <td>{{ $payment->value_coin }}</td>
							          </tr>
							          @endforeach
							      	</tbody>
                                </table>
                                <span style="margin: 0 auto;">{{ $payments->links() }}</span>
                            </div>

                        </div>
            		</div>
            	</div>
            </div>

@endsection
