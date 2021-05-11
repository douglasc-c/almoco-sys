@extends('restaurant.layouts.default')

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
                <form method="POST" action="{{URL::action('Restaurant\MenuController@createMenu')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                            <label for="date">Selecione a data</label>
                        <input type="date" id="date" name="date_menu" class="form-control">
                    </div>
                    {{-- <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputPassword1" style="color: black;">Acompanhamentos</label>
                                <div>
                                    @foreach($garnishs as $garnish)
                                        <input type="checkbox" id="{{$garnish->name}}" name="checkbox[{{$garnish->name}}]">

                                        <label for="scales" style="color: black;">{{$garnish->name}}</label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputPassword1" style="color: black;">Carnes</label>
                                <div>
                                        @foreach($meets as $meet)
                                            <input type="checkbox" id="{{$meet->name}}" name="checkbox[{{$meet->name}}]">

                                            <label for="scales" style="color: black;">{{$meet->name}}</label>
                                        @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputPassword1" style="color: black;">Verduras</label>
                                <div>
                                    @foreach($vegetables as $vegetable)
                                        <input type="checkbox" id="{{$vegetable->name}}" name="checkbox[{{$vegetable->name}}]">

                                        <label for="scales" style="color: black;">{{$vegetable->name}}</label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    @foreach($category as $category)
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputPassword1" style="color: white;">{{$category['name']}}</label>
                                <div>
                                    @foreach($category['itens'] as $item)
                                        <input type="checkbox" id="{{$item->name}}" name="checkbox[{{$item->name}}]">

                                        <label for="scales" style="color: white;">{{$item->name}}</label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="form-group">
                        <button type="submit" class="btn btn-light radius-30 btn-lg btn-block">Cadastrar</button>
                    </div>
                </form>
            </div>
    </div>


<div class="card">
    <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="menus-table" class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Dia</th>
                                            <th>Alimentos</th>
                                            <th>Criado em:</th>
                                            <th>Atualizado em:</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>


@endsection
@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<script>
    $(function() {
        $('#menus-table').DataTable({
            order: [[ 4, "desc" ]],
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{{URL::action('Restaurant\MenuController@dataMenu')}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            "columnDefs": [
                { "searchable": false, "targets": 3 }
            ],
            columns: [
                { data: 'id', name: 'menus.id' },
                { data: 'menu_day', name: 'menus.menu_day' },
                { data: 'foods_id', name: 'menus.foods_id' },
                { data: 'created_at', name: 'menus.created_at' },
                { data: 'updated_at', name: 'menus.updated_at' },
            ]
        });
    });
</script>

@stop
