@extends('restaurant.layouts.default')

@section('title')
Users -
@parent
@stop

@section('content')

<div class="row mb-4">
  <div class="col-12 d-flex align-items-center justify-content-between">
    <h4 class="page-title">Alimentos</h4>
    <button type="button" class="btn btn-light m-1 px-5 card-border-theme2 btn-theme2" data-toggle="modal" data-target="#newFood">Novo Alimento</button>
  </div>
</div>

<div class="row">

</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="foods-table" class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Categoria</th>
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

<div class="modal fade" id="newFood" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content radius-30">
        <div class="modal-header border-bottom-0">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-5">
          <form method="POST" action="{{URL::action('Restaurant\FoodController@createFood')}}">
              {{ csrf_field() }}
            <h3 class="text-center">Cadastrar Novo Alimento</h3>
            <div class="form-group">
              <label>Nome do alimento</label>
              <input type="text" name="name" class="form-control form-control-lg radius-30" placeholder="Digite o nome do alimento"/>
            </div>
            <div class="form-group">
              <label>Descrição</label>
              <input type="text" name="description" class="form-control form-control-lg radius-30" placeholder=""/>
            </div>
            <div class="form-group">
                    <label>Categorias</label>
                    <select class="form-control" name="category">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            <div class="form-group">
              <button type="submit" class="btn btn-light radius-30 btn-lg btn-block">Cadastrar</button>
            </div>

            <hr/>
          </form>
        </div>
      </div>
    </div>
</div>
{{-- end modal --}}

@endsection

@section('styles')
@stop

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<script>
    $(function() {
        $('#foods-table').DataTable({
            order: [[ 4, "desc" ]],
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{{URL::action('Restaurant\FoodController@dataFoods')}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            "columnDefs": [
                { "searchable": false, "targets": 3 }
            ],
            columns: [
                { data: 'id', name: 'foods.id' },
                { data: 'name', name: 'foods.name' },
                { data: 'description', name: 'foods.description' },
                { data: 'food_category_id', name: 'foods.food_category_id' },
                { data: 'created_at', name: 'foods.created_at' },
                { data: 'updated_at', name: 'foods.updated_at' },

            ]
        });
    });
</script>
@stop
