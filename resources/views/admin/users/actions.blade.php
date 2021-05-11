{{-- @if(Auth::user()->hasRole('adminCanActionUsers')) --}}
	<a href="{{URL::action('Admin\UsersController@edit', $user->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">Edit</i> </a>
{{-- @endif --}}

<a href="{{URL::action('Admin\UsersController@accessUser', $user->id)}}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Wallets" style="min-width: 30px;">Access</a>

<a data-toggle="modal" data-target="#modal-history" data-id="{{$user->id}}" id="getUserHistory" class="btn btn-sm btn-info" style="min-width: 30px;">Infos</a>

<a href="{{URL::action('Admin\UsersController@confirmEmail', $user->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Wallets" style="min-width: 30px;">validate Email</a>
@if($user->validated == 0)
    <a href="{{URL::action('Admin\UsersController@validateUserAccount', $user->id)}}" class="btn btn-sm btn-warning" style="min-width: 30px;"> validate document</a>
@endif
<button title="Creditar" type="button" class="btn btn-sm btn-success"  data-toggle="modal" data-target="#modalCredit{{$user->id}}">+credit</button>
<div class="modal" id="modalCredit{{$user->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Deseja Creditar algum valor para esse usuario?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{URL::action('Admin\UsersController@createCredit', $user->id)}}">
                {{ csrf_field() }}
                <div id="show_cancel_deposists">
                    <div class="input-group" style="margin-top: 20px">
                        <div class="input-group-prepend">
                            <p>Name: {{$user->name}}</p>
                        </div>
                    </div>
                    <div class="input-group" style="margin-top: 20px">
                        <div class="input-group-prepend">
                            Value:
                            <input type="text" name="value" placeholder="0.00">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Creditar Valor</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if(!in_array($user->id, [1,2,3, 39]))
    <a href="{{URL::action('Admin\UsersController@deleteUser', $user->id)}}" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Wallets" style="min-width: 30px;">Delete</a>
@endif
{{-- @if(in_array($user->id, [20]))
    <a href="{{URL::action('Admin\UsersController@changeUser', $user->id)}}" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Wallets" style="min-width: 30px;">Alterar</a>
@endif --}}

