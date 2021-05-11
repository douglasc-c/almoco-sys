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
							    <div class="col-md-4"><h2><strong>Manage</strong> Deposits Staking</h2></div>
							    {{-- @if($query != null)
							    <div class="col-md-4" style="text-align: right;">
							      <form  action="/admin/deposits-staking" method="get">
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
							      <form  action="/admin/deposits-staking" method="get">
							        <div class="input-group mb-3">
							          <input type="text" name="query" class="form-control" placeholder="Search by E-mail... " value="{{ $query }}">
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
                                    <thead class="">
			                            <tr>
			                                <th>ID</th>
			                                <th>E-mail</th>
			                                <th>Date</th>
			                                <th>Amount</th>
			                                <th>Bonus</th>
			                                <th>Period</th>
			                                <th>Expire Date</th>
			                                <th>Status</th>
			                                <th>Received</th>
			                                <th>Rest</th>
			                            </tr>
			                        </thead>
			                        <tbody>
			                        	@foreach($deposits as $deposit)
			                            <tr>
			                            	<td>{{$deposit->token}}</td>
			                            	<td>{{$deposit->user->email}}</td>
			                                <td>{{Carbon\Carbon::parse($deposit->created_at)->diffForHumans()}}</td>
			                                <td>{{bcdiv($deposit->value_paid, 1, 2)}}</td>
			                                <td>{{bcdiv($deposit->value - $deposit->value_paid, 1, 2)}}</td>
			                                <td>{{$deposit->type}} Months</td>
			                                <td>{{date('Y-m-d', strtotime($deposit->final_date))}}</td>
			                                <td>
			                                    @if($deposit->status)
			                                    <span class="badge badge-success">ACTIVE</span>
			                                    @else
			                                    <span class="badge badge-danger">INACTIVE</span>
			                                    @endif
			                                </td>
			                                <td>{{bcdiv($deposit->gains, 1, 2)}}</td>
			                                <td>{{bcdiv($deposit->rest, 1, 2)}}</td>
			                            </tr>
			                            @endforeach
			                        </tbody>
                                </table>
                                <span style="margin: 10 auto;">{{ $deposits->links() }}</span>
                            </div>

                        </div>
            		</div>
            	</div>
            </div>

@endsection
