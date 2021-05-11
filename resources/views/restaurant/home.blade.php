@extends('restaurant.layouts.default')

@section('title')


@parent
@stop

@section('content')

        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="card radius-15">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <h2>Número de confirmados</h2>
                        </div>
                        <div class="card radius-15" style="margin: 18px 20%;">
                            <div class="card-body text-center">
                                <h4>{{Carbon\Carbon::today()->addDays(2)->format('d/m/Y')}}</h4>
                                <h5>{{$orders['day+2']}} confirmados</h5>
                            </div>
                        </div>
                        <div class="card radius-15" style="margin: 18px 20%;">
                            <div class="card-body text-center">
                                <h4>{{Carbon\Carbon::today()->addDays(1)->format('d/m/Y')}}</h4>
                                <h5>{{$orders['day+1']}} confirmados</h5>
                            </div>
                        </div>
                        <div class="card radius-15" style="margin: 18px 20%;">
                            <div class="card-body text-center">
                                <h4 style="color: lawngreen;">{{Carbon\Carbon::today()->format('d/m/Y')}}</h4>
                                <h5 style="color: lawngreen;">{{$orders['today']}} confirmados</h5>
                            </div>
                        </div>
                        <div class="card radius-15" style="margin: 18px 20%;">
                            <div class="card-body text-center">
                                <h4>{{Carbon\Carbon::today()->subDays(1)->format('d/m/Y')}}</h4>
                                <h5>{{$orders['day-1']}} confirmados</h5>
                            </div>
                        </div>
                        <div class="card radius-15" style="margin: 18px 20%;">
                            <div class="card-body text-center">
                                <h4>{{Carbon\Carbon::today()->subDays(2)->format('d/m/Y')}}</h4>
                                <h5>{{$orders['day-2']}} confirmados</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="card radius-15">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <h2>Menu confirmado</h2>
                        </div>
                        <div class="card radius-15" style="margin: 18px 20%;">
                            <a href="{{URL::action('Restaurant\MenuController@show', "tomorrow")}}">
                                <div class="card-body ml-4">
                                    <h4 class="mb-3">{{Carbon\Carbon::today()->addDays(1)->format('d/m/Y')}}</h4>
                                    @foreach($all_category_next_day as $category)
                                        <h5>{{$category['amount']}} - {{$category['name']}}</h5>
                                    @endforeach
                                </div>
                            </a>
                        </div>
                        <div class="card radius-15" style="margin: 18px 20%;">
                                <a href="{{URL::action('Restaurant\MenuController@show', "today")}}">
                                <div class="card-body ml-4">
                                    <h4 class="mb-3" style="color: lawngreen;">{{Carbon\Carbon::today()->format('d/m/Y')}}</h4>
                                    @foreach($all_category as $category)
                                        <h5 style="color: lawngreen;">{{$category['amount']}} - {{$category['name']}}</h5>
                                    @endforeach
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
@section('scripts')
<script>
    function copyWallet() {
      var copyText = document.getElementById("address_wallet");
      copyText.select();
      copyText.setSelectionRange(0, 99999)
      document.execCommand("copy");
    }
    </script>
@stop
