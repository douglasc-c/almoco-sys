@extends('superadmin.layouts.default')

@section('title')
Users -
@parent
@stop

@section('content')

<div class="row mb-4">
  <div class="col-12 d-flex align-items-center justify-content-between">
    <h4 class="page-title">Alimentos</h4>
    {{-- <button type="button" class="btn btn-light m-1 px-5 card-border-theme2 btn-theme2" data-toggle="modal" data-target="#newCategory">Nova Categoria</button> --}}
  </div>
</div>

<div class="row">

</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="food-table" class="table table-striped table-bordered zero-configuration">
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

{{-- end modal --}}

@endsection

@section('styles')
@stop

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<script>
    $(function() {
        $('#food-table').DataTable({
            order: [[ 4, "desc" ]],
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{{URL::action('SuperAdmin\FoodController@dataFoods')}}',
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
                { data: 'food_category', name: 'food_categories.food_category' },
                { data: 'created_at', name: 'foods.created_at' },
                { data: 'updated_at', name: 'foods.updated_at' },

            ]
        });
    });
</script>
@stop
