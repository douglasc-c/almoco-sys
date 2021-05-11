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
			          <span class="d-block">{{bcdiv($total['paid'], 1, 2)}}</span>
			        </div>
			      </div>
			    </div>
			    <div class="col-md-4">
			      <div class="card m-b-30 ">
			        <div class="card-body text-center">
			          <strong class="d-block">Wallet Withdrawals Balance <b>{{bcdiv($wallet['balance'],1,4)}} ETH | {{bcdiv($wallet['balance_ethpy'],1,2)}} NVA</b>
			          </strong>
			          <span class="d-block"> <a href="https://etherscan.io/address/{{$wallet['address']}}" target="_blank">{{$wallet['address']}}</a>
			          </span>
			        </div>
			      </div>
			    </div>
		  	</div>

		  	<div class="row mb-4">
			    <div class="col-md-12">
			      <div class="btn-group justify-content-between" role="group" aria-label="Change Status" style="width: 100%;">
			        <a href="{{URL::action('Admin\WithdrawalsController@index', [$type_name, 0])}}" class="btn btn-warning {{(Request::url() == URL::action('Admin\WithdrawalsController@index', [$type_name, 0])) ? 'active' : ''}}">Pending</a>
			        <a href="{{URL::action('Admin\WithdrawalsController@index', [$type_name, 1])}}" class="btn btn-success text-white {{(Request::url() == URL::action('Admin\WithdrawalsController@index', [$type_name, 1])) ? 'active' : ''}}">Complete</a>
			        <a href="{{URL::action('Admin\WithdrawalsController@index', [$type_name, 2])}}" class="btn btn-danger text-white {{(Request::url() == URL::action('Admin\WithdrawalsController@index', [$type_name, 2])) ? 'active' : ''}}">Canceled</a>
			      </div>
			    </div>
		  	</div>

			<div class="row">
            	<div class="col-md-12">
            		<div class="card">
                        <div class="card-body">

                        	<div class="row" style="width: 100%;">
							    <div class="col-md-4"></div>
							    {{-- @if($query != null)
							    <div class="col-md-4" style="text-align: right;">
							      <form  action="/admin/withdrawals/stake/{{$status}}" method="get">
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
							      <form  action="/admin/withdrawals/stake/{{$status}}" method="get">
							        <div class="input-group mb-3">
							          <input type="text" name="query" class="form-control" placeholder="Search... " value="{{ $query }}">
							          <div class="input-group-prepend">
							            <button class="btn btn-primary" type="submit"> <i class="zmdi zmdi-search"></i> </button>
							          </div>
							        </div>
							      </form>

							    </div> --}}
							</div>

                        	<div class="table-responsive">
                                <table class="table table-hover m-b-0 table-striped table-bordered">
                                    <thead>
								        <tr>
								          <th>#</th>
								          <th>User</th>
								          <th>Created at</th>
								          <th>Amount</th>
								          <th>Address</th>
								          <th>Status</th>
								          <th>Action</th>
								        </tr>
							      	</thead>
							      	<tbody>
								        @if(count($withdrawals) == 0)
								          <tr>
								            <td colspan="12" style="padding: 20px;">No results for your search.</td>
								          </tr>
								        @else
								          @foreach($withdrawals as $withdrawal)
								          <tr>
								            <td>{{ $withdrawal->id }}</td>
								            <td>{{ $withdrawal->user->email }}</td>
								            <td>{{ $withdrawal->created_at }}</td>
								            <td><span class="text-{{($withdrawal->value < 0) ? 'danger' : 'success'}}">{{ bcdiv($withdrawal->value, 1, 2) }} NVA</span></td>
								            <td>{{ $withdrawal->address }}</td>
								            <td>
								            	@if($withdrawal->status == 1)
								            		<span class="badge badge-success">Paid</span>
								            	@elseif($withdrawal->status == 2)
								            		<span class="badge badge-danger">Canceled</span>
								            	@else
								            		<span class="badge badge-warning">Pending</span>
								            	@endif
								            </td>
								            <td>
								            	@if($withdrawal->status == 0)
									            	@if(Auth::user()->hasRole('adminCanActionWithdrawals') || true)
										            	{{-- <a href="#modal-dialog" data-toggle="modal" data-href="{{{ URL::action('Admin\WithdrawalsController@approve', [$withdrawal->id])  }}}" class="btn btn-sm btn-success text-white"><i class="fa fa-check"></i> Approve</a>
										            	<a href="#modal-dialog" data-toggle="modal" data-href="{{{ URL::action('Admin\WithdrawalsController@cancel', [$withdrawal->id])  }}}" class="btn btn-sm btn-danger text-white"><i class="fa fa-close"></i> Cancel</a>

										            	<a href="#modal-manual" data-toggle="modal" data-href="{{{ URL::action('Admin\WithdrawalsController@approveManual', [$withdrawal->id])  }}}" class="btn btn-sm btn-info text-white"><i class="fa fa-check"></i> Approve Manual</a> --}}



										            	<div id="modal-manual" class="modal fade animate black-overlay" tabindex="99" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
														    <div class="modal-dialog modal-sm">
														      <div class="modal-content flip-y" style="margin-top: 75%!important">
														      	<form action="{{URL::action('Admin\WithdrawalsController@approveManual')}}" method="post">
														      		{{csrf_field()}}
														        <div class="modal-body text-center">
														          <p class="py-3 mt-3"><i class="zmdi zmdi-check-circle"></i></p>
														          <p>Approve manual Withdrawal</p>

														          <input type="text" name="hash" placeholder="Hash here">
														          <input type="hidden" name="withdrawal_id" value="{{$withdrawal->id}}">
														        </div>
														        <div class="modal-footer">
														          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
														          <button class="btn btn-success text-white">Approve</button>

														        </div>
														        </form>
														      </div>
														    </div>
													  	</div>
										            @endif
								            	@endif
								            	@if($withdrawal->status == 1)
								            	<a href="https://etherscan.io/tx/{{$withdrawal->txid}}" class="btn btn-primary btn-sm" target="_blank">Hash</a>
								            	@endif
								            </td>
								          </tr>
								          @endforeach
								        @endif
							      	</tbody>
                                </table>
                                <span style="margin: 0 auto;">{{ $withdrawals->links() }}</span>
                            </div>

                        </div>
            		</div>
            	</div>
            </div>

@endsection

@section('styles')
<style type="text/css">
	.modal-backdrop.show {
    opacity: 0!important;
}
.modal-backdrop {
     position: relative;
}
</style>
@endsection
