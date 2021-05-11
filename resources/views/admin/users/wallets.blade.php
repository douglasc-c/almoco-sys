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
		@foreach($coins as $coin)
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<center class="mb-2">
						<img src="/assets/images/coins/{{$coin->symbol}}.png" style="max-height: 60px;"><br /><br />
						{{$coin->name}} ({{$coin->symbol}})
					</center>
					<div class="row">
						<div class="col-md-12 text-center">
							<p class="mt-2 mb-2" style="font-size: 12px;"><b class="text-center" style="font-weight: bold;"><a href="{{$coin->blockchain_address}}{{$wallet[$coin->symbol]['address']}}" target="_blank">{{($wallet) ? $wallet[$coin->symbol]['address'] : '--'}}</a></b></p>
						</div>
						<div class="col-md-6">
							<div class="card card-body text-center mb-3">
								<h6 class="mb-0" style="font-weight: bold;">{{($wallet[$coin->symbol]) ? $wallet[$coin->symbol]->balance($coin->symbol)['enable'] : '0.0000'}}</h6>
								<small class="text-muted mb-0">Balance Enable</small>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card card-body text-center mb-3">
								<h6 class="mb-0" style="font-weight: bold;">{{($wallet[$coin->symbol]) ? $wallet[$coin->symbol]->balance($coin->symbol)['pending'] : '0.0000'}}</h6>
								<small class="text-muted mb-0">Balance Pending</small>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>

	<div class="row">
		<div class="col-md-12">
            <ul class="nav nav-tabs nav-justified">
            	@foreach($coins as $coin)
                <li class="nav-item"><a class="nav-link {{($coin->order == 1) ? 'active' : ''}}" data-toggle="tab" href="#{{$coin->symbol}}tab">{{$coin->name}} ({{$coin->symbol}})</a></li>
                @endforeach
            </ul>
			<div class="card card-custom card-stretch gutter-b">
                <div class="card-body">
                    <div class="tab-content">
                        @foreach($coins as $coin)
                        <div role="tabpanel" class="tab-pane {{($coin->order == 1) ? 'in active' : ''}}" id="{{$coin->symbol}}tab">
                            <div class="table-responsive table_middel">
                                @if($transactions[$coin->symbol]->count() >= 0)
                                <table class="table mb-0">
                                    <thead class="">
                                        <tr>
                                            <th>Type</th>
                                            <th>Hash</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($transactions[$coin->symbol] as $transaction)
                                        <tr>
                                            <td>
                                                @if($transaction->type == 'send')
                                                <img src="/assets/images/icons/send.png" class="rounded-circle avatar mr-2" alt="profile-image">
                                                @else
                                                <img src="/assets/images/icons/received.png" class="rounded-circle avatar mr-2" alt="profile-image">
                                                @endif
                                                <span>{{($transaction->type == 'receive') ? 'Received' : 'Sended'}}</span>
                                            </td>
                                            <td><span><a href="{{$coin->blockchain_txid}}{{$transaction->txid}}" target="_blank" class="text-muted">{{$transaction->txid}}</a></span></td>
                                            <td>{{Carbon\Carbon::parse($transaction->created_at)->diffForHumans()}}</td>
                                            <td>{{$transaction->amount}}</td>
                                            <td><span class="badge badge-success">COMPLETE</span></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                    <center class="mt-5 mb-5">
                                        <img src="/assets/images/icons/Transactions.svg" style="width: 200px;"><br/><br />
                                        No transactions in this Wallet.
                                    </center>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
			</div>
		</div>
	</div>

@endsection
