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

        @if(Auth::user()->hasRole('adminCanActionCredits'))
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">Create Mual Credit - {{$type_name}}</div>
                <div class="card-body">

                    <form method="POST" action="{{URL::action('Admin\CreditsController@createCredit', $type_name)}}">

                        @csrf

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group mb-1">
                                    <div class="input-group">
                                        <input type="text" class="form-control  @error('code') is-invalid @enderror" placeholder="User Code" name="code" value="{{ old('code') }}" required>
                                    </div>
                                    @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-1">
                                    <div class="input-group">
                                        <input type="text" class="form-control  @error('value') is-invalid @enderror" placeholder="0.00" name="value" value="{{ old('value') }}" required>
                                    </div>
                                    @error('value')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-1">
                                    <div class="input-group">
                                        <input type="text" class="form-control  @error('description') is-invalid @enderror" placeholder="Description of Credit" name="description" value="{{ old('description') }}" required>
                                    </div>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-1">
                                    <div class="input-group">
                                        <button type="submit" class="btn btn-success btn-block text-white">Create</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        @endif

        <div class="col-md-12">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-body">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4"><h5><strong>Manage</strong> Credits - {{$type_name}}</h5></div>
                            @if($query != null)
                            <div class="col-md-4" style="text-align: right;">
                            <form  action="/admin/wallets/{{$type_name}}" method="get">
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
                            <form  action="/admin/wallets/{{$type_name}}" method="get">
                                <div class="input-group mb-0">
                                <input type="text" name="query" class="form-control" placeholder="Search by Email... " value="{{ $query }}">
                                <div class="input-group-prepend">
                                    <button class="btn btn-primary" type="submit"> <i class="zmdi zmdi-search"></i> </button>
                                </div>
                                </div>
                            </form>

                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table_middel">
                        @if($totalCredits >= 0)
                            @if($type_name == 'stake')
                                <table class="table mb-0">
                                    <thead class="">
                                        <tr>
                                            <th>Type</th>
                                            <th>User</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($credits as $credit)
                                        <tr>
                                            <td>
                                                <span>{{($credit->value > 0) ? 'Received' : 'Sended'}}</span>
                                            </td>
                                            <td>{{$credit->user->email}}</td>
                                            <td>{{Carbon\Carbon::parse($credit->created_at)->diffForHumans()}}</td>
                                            <td>{{bcdiv($credit->value, 1, 4)}}</td>
                                            <td>{{$credit->description}}</td>
                                            <td>
                                                @if($credit->status == 0)
                                                <span class="badge badge-warning">Pending</span>
                                                @else
                                                <span class="badge badge-success">Enable</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(Auth::user()->hasRole('adminCanActionCredits'))
                                                <a href="#modal-dialog" data-toggle="modal" data-href="{{{ URL::action('Admin\CreditsController@cancel', [$credit->id])  }}}" class="btn btn-sm btn-danger text-white"><i class="fa fa-close"></i> Cancel</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <span style="margin: 0 auto;">{{ $credits->links() }}</span>
                            @else
                            <table class="table mb-0">
                                    <thead class="">
                                        <tr>
                                            <th>Type</th>
                                            <th>User</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Hash</th>
                                            <th>Confirmations</th>
                                            <th>From</th>
                                            <th>To</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($credits as $credit)
                                        <tr>
                                            <td>
                                                <span>{{$credit->type}}</span>
                                            </td>
                                            <td>{{$credit->user_id}}</td>
                                            <td>{{Carbon\Carbon::parse($credit->created_at)->diffForHumans()}}</td>
                                            <td>{{bcdiv($credit->value, 1, 6)}}</td>
                                            <td>{{$credit->hash}}</td>
                                            <td>{{$credit->confirmations}}</td>
                                            <td>{{$credit->from}}</td>
                                            <td>{{$credit->to}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                            @endif
                        @else
                            <center class="mt-5 mb-5">
                                <img src="/assets/images/icons/Transactions.svg" style="width: 200px;" ><br/><br />
                                No {{ucfirst($type_name)}} history.
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
