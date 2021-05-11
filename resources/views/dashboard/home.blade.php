@extends('dashboard.layouts.default')

@section('title')


@parent
@stop

@section('content')
      <div class="card radius-15">
            <div class="card-body">
                <div class="card-title">
                        <h2>Adicionar itens</h2>
                </div>
                <hr/>
                {{-- <form method="POST" action="{{URL::action('Restaurant\MenuController@createMenu')}}"> --}}

                    <div class="form-group">
                            <label for="date">Confirmar</label>
                        {{-- <input type="date" id="date" name="date_menu" class="form-control"> --}}
                    </div>

                    @foreach($menus as $menu)
                    <form method="POST" action="{{URL::action('Dashboard\HomeController@confirmMenu')}}">
                        {{ csrf_field() }}
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputPassword1" style="color: white;">{{$menu['day']}}</label>
                                    <div>
                                        @foreach($menu['itens'] as $item)
                                            <input type="checkbox" id="{{$item['id']}}" name="checkbox[{{$item['id']}}]">

                                            <label for="scales" style="color: white;">{{$item['name']}}</label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="{{$menu['id']}}" name="menu_id">
                            <input type="hidden" value="{{$menu['day']}}" name="menu_date">
                            <div class="form-group">
                                <button type="submit" class="btn btn-light radius-30 btn-lg btn-block" style="background-color: #88669a">Confirmar</button>
                            </div>
                        </div>
                    </form>
                    @endforeach
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
