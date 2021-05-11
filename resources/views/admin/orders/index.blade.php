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
							    <div class="col-md-4"><h2><strong>Manage</strong> Orders</h2></div>
							    {{-- @if($query != null)
							    <div class="col-md-4" style="text-align: right;">
							      <form  action="/admin/orders" method="get">
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
							      <form  action="/admin/orders" method="get">
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
								          <th>User</th>
								          <th>Created at</th>
								          <th>Amount</th>
								          <th>Status</th>
								          <th>Coin</th>
								          <th>From</th>
								          <th>Hash</th>
								        </tr>
							      	</thead>
							      	<tbody>
								        @if(count($orders) == 0)
								          <tr>
								            <td colspan="5" style="padding: 20px;">No results for your search.</td>
								          </tr>
								        @else
								          @foreach($orders as $order)
								          <tr>
								            <td>{{ $order->id }}</td>
								            <td>{{ $order->user->email }}</td>
								            <td>{{ $order->created_at }}</td>
								            <td><span class="text-{{($order->total < 0) ? 'danger' : 'success'}}">{{ bcdiv($order->total, 1, 2) }} NVA</span></td>
								            <td>
								            	@if($order->status_id == 6)
			                                        <span class="badge badge-success text-white">{{App\OrderStatus::where('id', $order->status_id)->first()->name}}</span>
			                                    @elseif($order->status_id == 9)
			                                        <span class="badge badge-danger text-white">{{App\OrderStatus::where('id', $order->status_id)->first()->name}}</span>
			                                    @else
			                                        <span class="badge badge-warning text-white">
			                                          Not done
			                                        </span>
			                                    @endif
								            </td>
								             <td>
								            	@if($order->payment_method == 'bitcoin')
								            		<span class="badge badge-warning text-white">
			                                          Bitcoin
			                                        </span>
								            	@else
								            		<span class="badge badge-info text-white">
			                                          Neeva
			                                        </span>
								            	@endif

								            </td>

								            <td>
								            	@if($order->payment_method == 'bitcoin' && $order->payment)
								            		<a href="https://www.blockchain.com/btc/address/{{$order->payment->address}}" target="_blank" class="btn btn-info text-white">
			                                          External
			                                        </a>
								            	@elseif($order->payment_method == 'wallet_default')
								            		<span class="badge badge-success text-white">
			                                          Wallet Default
			                                        </span>
			                                    @elseif($order->payment_method == 'neeva')
								            		<span class="badge badge-success text-white">
			                                          Neeva
			                                        </span>

								            	@endif

                                            </td>
                                            <td>
                                                <a href="https://etherscan.io/tx/{{$order->hash_send}}" target="_blank">{{$order->hash_send}}</a>
                                            </td>
								            {{-- <td>
								            	@if($order->status_id == 1)
								            	@if(Auth::user()->hasRole('adminCanActionOrders') || true)
									            	<a href="#modal-dialog" data-toggle="modal" data-href="{{{ URL::action('Admin\OrdersController@approve', [$order->id])  }}}" class="btn btn-sm btn-success text-white"><i class="fa fa-check"></i> Approve (with Bonus)</a>
									            	<a href="#modal-dialog" data-toggle="modal" data-href="{{{ URL::action('Admin\OrdersController@approve', [$order->id, 0])  }}}" class="btn btn-sm btn-success text-white"><i class="fa fa-check"></i> Approve (no Bonus)</a>
									            @endif
								            	@endif
								            	@if($order->payment)
								            	<a href="https://etherscan.io/address/{{$order->payment->address}}#tokentxns" class="btn btn-primary btn-sm" target="_blank">Address</a>
								            	@endif
                                            </td> --}}
                                            {{-- <td>
                                                @if($order->id != 52 && $order->id != 30)
                                                    <a href="{{URL::action('Admin\OrdersController@deleteOrder', $order->id)}}" class="btn btn-danger btn-sm">Deletar</a>
                                                @endif
                                            </td> --}}
                                            {{-- <td>
                                                <a href="{{URL::action('Admin\OrdersController@selectPackage', $order->id)}}" class="btn btn-danger btn-sm">Definir plano</a>
                                            </td> --}}
								          </tr>
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
