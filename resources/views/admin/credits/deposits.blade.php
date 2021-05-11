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
        <div class="col-md-12">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-body">
                    <div class="table-responsive table_middel">
                        @if($totalDeposits > 0)
                        <table class="table mb-0">
                            <thead class="">
                                <tr>
                                    <th>User</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($deposits as $deposit)
                                <tr>
                                    <td>{{$deposit->user->code}}</td>
                                    <td>{{Carbon\Carbon::parse($deposit->created_at)->diffForHumans()}}</td>
                                    <td>{{bcdiv($deposit->amount, 1, 2)}}</td>
                                    <td><a href="https://etherscan.io/tx/{{$deposit->input_hash}}" target="_blank">{{$deposit->input_hash}}</a></td>
                                    <td>
                                        @if($deposit->status == 1)
                                        <span class="badge badge-success">Complete</span>
                                        @else
                                        <span class="badge badge-warning">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <span style="margin: 0 auto;">{{ $deposits->links() }}</span>
                        @else
                            <center class="mt-5 mb-5">
                                <img src="/assets/images/icons/Transactions.svg" style="width: 200px;"><br/><br />
                                No Deposits in your account.
                            </center>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('styles')

@stop

@section('scripts')

@stop
