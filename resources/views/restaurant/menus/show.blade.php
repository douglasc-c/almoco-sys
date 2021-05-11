@extends('restaurant.layouts.default')

@section('title')

@parent
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card radius-15">
                <div class="card-body">
                    <div class="card-title text-center">
                        <h2>Menu confirmado dia {{$date}}</h2>
                    </div>
                    <div class="card radius-15" style="margin: 18px 20%;">
                        <div class="card-body ml-4" style="margin: 0 auto;">
                            @foreach($all_foods as $food)
                                <h5 style="color: lawngreen;">{{$food['amount']}} - {{$food['name']}}</h5>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop
