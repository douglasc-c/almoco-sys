@extends('superadmin.layouts.default')

@section('title')
Users -
@parent
@stop

@section('content')

<div class="row mb-4">
  <div class="col-12 d-flex align-items-center justify-content-between">
    <h4 class="page-title">Categorias</h4>
    <button type="button" class="btn btn-light m-1 px-5 card-border-theme2 btn-theme2" data-toggle="modal" data-target="#newCategory">Nova Categoria</button>
  </div>
</div>

<div class="row">

</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="food-categories-table" class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Descrição</th>
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

<div class="modal fade" id="newCategory" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content radius-30">
        <div class="modal-header border-bottom-0">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-5">
          <form method="POST" action="{{URL::action('SuperAdmin\FoodController@createCategory')}}">
              {{ csrf_field() }}
            <h3 class="text-center">Cadastrar Nova Categoria</h3>
            <div class="form-group">
              <label>Nome da categoria</label>
              <input type="text" name="name" class="form-control form-control-lg radius-30" placeholder="Digite a categoria"/>
            </div>
            <div class="form-group">
              <label>Descrição</label>
              <input type="text" name="description" class="form-control form-control-lg radius-30" placeholder=""/>
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
        $('#food-categories-table').DataTable({
            order: [[ 4, "desc" ]],
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{{URL::action('SuperAdmin\FoodController@dataFoodsCategories')}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            "columnDefs": [
                { "searchable": false, "targets": 3 }
            ],
            columns: [
                { data: 'id', name: 'food_categories.id' },
                { data: 'name', name: 'food_categories.name' },
                { data: 'description', name: 'food_categories.description' },
                { data: 'created_at', name: 'food_categories.created_at' },
                { data: 'updated_at', name: 'food_categories.updated_at' },

            ]
        });
    });
</script>
@stop
