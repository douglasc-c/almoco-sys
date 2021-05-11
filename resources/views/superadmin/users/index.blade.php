@extends('superadmin.layouts.default')

@section('title')
Users -
@parent
@stop

@section('content')

<div class="row mb-4">
  <div class="col-12 d-flex align-items-center justify-content-between">
    <h4 class="page-title">Usuários</h4>
    <button type="button" class="btn btn-light m-1 px-5 card-border-theme2 btn-theme2" data-toggle="modal" data-target="#newUser">Cadastrar Usuário</button>
  </div>
</div>

<div class="row">
    <div class="col-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex text-center">
              <div class="inner flex-grow text-center card-text-center">
                <p class="mb-5 text-center" >Super Admin</p>
                <h4 class="font-weight-bold">{{$total['users_super_admin']}}</h4>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex text-center">
              <div class="inner flex-grow text-center card-text-center">
                <p class="mb-5 text-center" >Admin</p>
                <h4 class="font-weight-bold">{{$total['users_admin']}}</h4>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex text-center">
              <div class="inner flex-grow text-center card-text-center">
                <p class="mb-5 text-center" >Usuários</p>
                <h4 class="font-weight-bold">{{$total['users']}}</h4>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex text-center">
              <div class="inner flex-grow text-center card-text-center">
                <p class="mb-5 text-center" >Usuários Restaurante</p>
                <h4 class="font-weight-bold">{{$total['users_restaurant']}}</h4>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="users-table" class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>CPF</th>
                                <th>Código compralo</th>
                                <th>Criado em</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- New User modal --}}
<div class="modal fade" id="newUser" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content radius-30">
        <div class="modal-header border-bottom-0">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-5">
          <form method="POST" action="{{URL::action('SuperAdmin\UsersController@createUser')}}">
              {{ csrf_field() }}
            <h3 class="text-center">Cadastrar Novo Usuário</h3>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control form-control-lg radius-30" placeholder="Digite o email do usuário"/>
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
        $('#users-table').DataTable({
            order: [[ 4, "desc" ]],
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{{URL::action('SuperAdmin\UsersController@dataUsers')}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            "columnDefs": [
                { "searchable": false, "targets": 3 }
            ],
            columns: [
                { data: 'id', name: 'users.id' },
                { data: 'name', name: 'users.name' },
                { data: 'email', name: 'users.email' },
                { data: 'compralo_code', name: 'users.compralo_code' },
                { data: 'cpf', name: 'users.cpf' },
                { data: 'created_at', name: 'users.created_at' },

            ]
        });
    });
</script>
@stop
