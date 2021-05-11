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
                <div class="col-md-6">
                    <div class="card card-custom gutter-b" style="height: 150px">
                        <div class="card-body d-flex align-items-center justify-content-between flex-wrap">
                            <div class="mr-2">
                                <h3 class="font-weight-bolder">Wallet Receivement Balance <b>{{bcdiv($walletFee['balance'],1,2)}} NVA</b></h3>
                                <div class="text-dark-50 font-size-lg mt-2"><span class="d-block mt-2"> <a href="https://etherscan.io/address/{{$walletFee['address']}}" target="_blank">{{$walletFee['address']}}</a> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-custom gutter-b" style="height: 150px">
                        <div class="card-body d-flex align-items-center justify-content-between flex-wrap">
                            <div class="mr-2">
                                <h3 class="font-weight-bolder">Wallet Withdrawals Balance <b>{{bcdiv($walletWithdrawal['balance'],1,2)}} ETH</b> | <b>{{bcdiv($walletWithdrawal['balance_nva'],1,2)}} NVA</b></h3>
                                <div class="text-dark-50 font-size-lg mt-2"><span class="d-block mt-2"> <a href="https://etherscan.io/address/{{$walletWithdrawal['address']}}" target="_blank">{{$walletWithdrawal['address']}}</a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
            	<div class="col-md-4">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark"><strong>Latest</strong> Users</span>
                            </h3>
                        </div>
                        <!--begin::Body-->
                        <div class="card-body py-0">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">
                                    <thead>
                                        <tr class="text-left">
                                            <th style="min-width: 30px">Id</th>
                                            <th style="min-width: 100px">Name</th>
                                            <th class="pr-0" style="min-width: 150px">Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td>
                                                <span class="text-muted font-weight-bold">{{$user->id}}</span>
                                            </td>
                                            <td>
                                                    <span class="text-muted font-weight-bold">{{$user->name}}</span>
                                            </td>
                                            <td>
                                                    <span class="text-muted font-weight-bold">{{$user->email}}</span>
                                            </td>
                                        @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end::Body-->
                    </div>
            	</div>
            	<div class="col-md-4">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark"><strong>Latest</strong> Transactions Default</span>
                            </h3>
                        </div>
                        <!--begin::Body-->
                        <div class="card-body py-0">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">
                                    <thead>
                                        <tr class="text-left">
                                            <th style="min-width: 30px">Id</th>
                                            <th style="min-width: 50px">code</th>
                                            <th style="min-width: 50px">amount</th>
                                            <th style="min-width: 50px">created at</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($transactionsDefault as $transaction)
                                        <tr>
                                            <td>
                                            <span class="text-muted font-weight-bold">{{$transaction->id}}</span>
                                            </td>
                                            <td>
                                                <span class="text-muted font-weight-bold">{{$transaction->user->code}}</span>
                                            </td>
                                            <td>
                                                <span class="text-muted font-weight-bold">{{$transaction->amount}}</span>
                                            </td>
                                            <td>
                                                <span class="text-muted font-weight-bold">{{date('Y-m-d', strtotime($transaction->created_at))}}</span>
                                            </td>
                                        @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end::Body-->
                    </div>
            	</div>
                <div class="col-md-4">
                    <div class="card card-custom card-stretch gutter-b">
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark"><strong>Latest</strong> Transactions Staking</span>
                            </h3>
                        </div>
                        <!--begin::Body-->
                        <div class="card-body py-0">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_1">
                                    <thead>
                                        <tr class="text-left">
                                            <th style="min-width: 30px">Id</th>
                                            <th style="min-width: 50px">code</th>
                                            <th style="min-width: 50px">amount</th>
                                            <th style="min-width: 50px">created at</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($transactionsStake as $transaction)
                                        <tr>
                                            <td>
                                            <span class="text-muted font-weight-bold">{{$transaction->id}}</span>
                                            </td>
                                            <td>
                                                <span class="text-muted font-weight-bold">{{$transaction->user->code}}</span>
                                            </td>
                                            <td>
                                                <span class="text-muted font-weight-bold">{{$transaction->amount}}</span>
                                            </td>
                                            <td>
                                                <span class="text-muted font-weight-bold">{{date('Y-m-d', strtotime($transaction->created_at))}}</span>
                                            </td>
                                        @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end::Body-->
                        </div>
                </div>
            </div>

@endsection
