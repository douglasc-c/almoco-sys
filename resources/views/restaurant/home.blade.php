@extends('restaurant.layouts.default')

@section('title')


@parent
@stop

@section('content')
<div class="row">
    <div class="col-xl-3">
        <div class="row">
            <div class="col-xl-12">
                <div class="accordion custom-card main-card-bg main-card-padding" id="accordion_select-month">
                    <div id="headingOne">
                        <a class="custom-card-header" data-toggle="collapse" data-target="#select-month" aria-expanded="true" aria-controls="select-month">
                            <h6>
                                selecione o mês que deseja editar
                                <span class="custom-collapse-arrow"></span>
                            </h6>
                        </a>
                    </div>
                    <div id="select-month" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_select-month">
                        <div class="card-body">
MESES
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion custom-card main-card-bg main-card-padding" id="accordionExample" >
            <div class="col-xl-12 custom-card-header-bloc">
                <h6>Selecione o dia que deseja editar</h6>
            </div>
            <div class="col-xl-12" style="margin-top: 3%;">
                <table class="main-calendar">
                    <tr>
                        <th>Seg</th>
                        <th>Ter</th>
                        <th>Qua</th>
                        <th>Qui</th>
                        <th>Sex</th>
                        <th>Sab</th>
                        <th>Dom</th>
                    </tr>
                    <tr class="top-tr">
                        <td>
                            <div class="calendar-bubble-day">
                                01
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                02
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                03
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                04
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                05
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                06
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                07
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="calendar-bubble-day">
                                08
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                09
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                10
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                11
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                12
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                13
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                14
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="calendar-bubble-day">
                                15
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                16
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                17
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                18
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                19
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                20
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                21
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="calendar-bubble-day">
                                22
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                23
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                24
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                25
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                26
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                27
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                28
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="calendar-bubble-day">
                                29
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                30
                            </div>
                        </td>
                        <td>
                            <div class="calendar-bubble-day">
                                31
                            </div>
                        </td>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xl-3">
        <div class="custom-card dark-card-bg main-card-padding">
            <div class="row">
                <div class="col-xl-12 custom-card-header-bloc">
                    <a href="" class="" data-toggle="modal" data-target="#modal_add-menu">
                        <h6>Adicionar menu</h6>
                    </a>
                </div>
            </div>
        </div>
<!-- bloco de menu, pode ser adicionado através do modal -->
        <div class="row">
            <div class="col-xl-12">
                <div class="accordion custom-card main-card-bg custom-card-padding-1" id="accordion_add-acompanhamento">
                    <a class="custom-card-header" data-toggle="collapse" data-target="#collapse_add-acompanhamento" aria-expanded="true" aria-controls="collapse_add-acompanhamento">
                        <div class="custom-card-min-header" id="headingOne">
                        
                            <h6>
                                Acompanhamentos
                                <span class="custom-collapse-arrow"></span>
                            </h6>
                        </div>
                    </a>
                    <div id="collapse_add-acompanhamento" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_add-acompanhamento">
                        <div class="card-body">
                            <ul class="menu-ul">
                                <!-- list item -->
                                <li>
                                    <div class="row menu-list-row">
                                        <div class="col-xl-2 zeroed-col menu-list-checkbox-bloc">
                                            <div class="rounded-checkbox">
                                                <input type="checkbox" id="checkbox-legumesnamanteiga" />
                                                <label for="checkbox-legumesnamanteiga"></label>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 zeroed-col">
                                            <label for="checkbox-legumesnamanteiga" class="menu-list-title">Legumes na Manteiga</label>
                                        </div>
                                        <div class="col-xl-1 zeroed-col">
                                            <a href="" class="menu-list-edit-item">
                                                <i class="fa fa-pencil-square main-icon-size"></i>
                                            </a>
                                        </div>
                                        <div class="col-xl-1 zeroed-col">
                                            <a href="" class="menu-list-delete-item">
                                                <i class="fa fa-trash-o main-icon-size"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <!-- list item -->
                                <li>
                                    <div class="row menu-list-row">
                                        <div class="col-xl-2 zeroed-col menu-list-checkbox-bloc">
                                            <div class="rounded-checkbox">
                                                <input type="checkbox" id="checkbox-polentafrita" />
                                                <label for="checkbox-polentafrita"></label>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 zeroed-col">
                                            <label for="checkbox-polentafrita" class="menu-list-title">Polenta Frita</label>
                                        </div>
                                        <div class="col-xl-1 zeroed-col">
                                            <a href="" class="menu-list-edit-item">
                                                <i class="fa fa-pencil-square main-icon-size"></i>
                                            </a>
                                        </div>
                                        <div class="col-xl-1 zeroed-col">
                                            <a href="" class="menu-list-delete-item">
                                                <i class="fa fa-trash-o main-icon-size"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <!-- list item -->
                                <li>
                                    <div class="row menu-list-row">
                                        <div class="col-xl-2 zeroed-col menu-list-checkbox-bloc">
                                            <div class="rounded-checkbox">
                                                <input type="checkbox" id="checkbox-bolinhoarroz" />
                                                <label for="checkbox-bolinhoarroz"></label>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 zeroed-col">
                                            <label for="checkbox-bolinhoarroz" class="menu-list-title">Bolinho de Arroz</label>
                                        </div>
                                        <div class="col-xl-1 zeroed-col">
                                            <a href="" class="menu-list-edit-item">
                                                <i class="fa fa-pencil-square main-icon-size"></i>
                                            </a>
                                        </div>
                                        <div class="col-xl-1 zeroed-col">
                                            <a href="" class="menu-list-delete-item">
                                                <i class="fa fa-trash-o main-icon-size"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- bloco de menu, pode ser adicionado através do modal -->
        <div class="row">
            <div class="col-xl-12">
                <div class="accordion custom-card main-card-bg custom-card-padding-1" id="accordion_add-carne">
                    <a class="custom-card-header" data-toggle="collapse" data-target="#collapse_add-carne" aria-expanded="true" aria-controls="collapse_add-carne">
                        <div class="custom-card-min-header" id="headingOne">
                        
                            <h6>
                                Carnes
                                <span class="custom-collapse-arrow"></span>
                            </h6>
                        </div>
                    </a>
                    <div id="collapse_add-carne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_add-carne">
                        <div class="card-body">
                            <ul class="menu-ul">
                                <li>
                                    <div class="row menu-list-row">
                                        <div class="col-xl-2 zeroed-col menu-list-checkbox-bloc">
                                            <div class="rounded-checkbox">
                                                <input type="checkbox" id="checkbox-frango" />
                                                <label for="checkbox-frango"></label>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 zeroed-col">
                                            <label for="checkbox-frango" class="menu-list-title">Frango</label>
                                        </div>
                                        <div class="col-xl-1 zeroed-col">
                                            <a href="" class="menu-list-edit-item">
                                                <i class="fa fa-pencil-square main-icon-size"></i>
                                            </a>
                                        </div>
                                        <div class="col-xl-1 zeroed-col">
                                            <a href="" class="menu-list-delete-item">
                                                <i class="fa fa-trash-o main-icon-size"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <!-- list item -->
                                <li>
                                    <div class="row menu-list-row">
                                        <div class="col-xl-2 zeroed-col menu-list-checkbox-bloc">
                                            <div class="rounded-checkbox">
                                                <input type="checkbox" id="checkbox-almondega" />
                                                <label for="checkbox-almondega"></label>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 zeroed-col">
                                            <label for="checkbox-almondega" class="menu-list-title">Almondega</label>
                                        </div>
                                        <div class="col-xl-1 zeroed-col">
                                            <a href="" class="menu-list-edit-item">
                                                <i class="fa fa-pencil-square main-icon-size"></i>
                                            </a>
                                        </div>
                                        <div class="col-xl-1 zeroed-col">
                                            <a href="" class="menu-list-delete-item">
                                                <i class="fa fa-trash-o main-icon-size"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <!-- list item -->
                                <li>
                                    <div class="row menu-list-row">
                                        <div class="col-xl-2 zeroed-col menu-list-checkbox-bloc">
                                            <div class="rounded-checkbox">
                                                <input type="checkbox" id="checkbox-steakfrango" />
                                                <label for="checkbox-steakfrango"></label>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 zeroed-col">
                                            <label for="checkbox-steakfrango" class="menu-list-title">Steak de frango</label>
                                        </div>
                                        <div class="col-xl-1 zeroed-col">
                                            <a href="" class="menu-list-edit-item">
                                                <i class="fa fa-pencil-square main-icon-size"></i>
                                            </a>
                                        </div>
                                        <div class="col-xl-1 zeroed-col">
                                            <a href="" class="menu-list-delete-item">
                                                <i class="fa fa-trash-o main-icon-size"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="accordion custom-card main-card-bg custom-card-padding-1" id="accordion_add-salada">
                    <a class="custom-card-header" data-toggle="collapse" data-target="#collapse_add-salada" aria-expanded="true" aria-controls="collapse_add-salada">
                        <div class="custom-card-min-header" id="headingOne">
                        
                            <h6>
                                Saladas
                                <span class="custom-collapse-arrow"></span>
                            </h6>
                        </div>
                    </a>
                    <div id="collapse_add-salada" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_add-salada">
                        <div class="card-body">
                            <ul class="menu-ul">
                                <li>
                                    <div class="row menu-list-row">
                                        <div class="col-xl-2 zeroed-col menu-list-checkbox-bloc">
                                            <div class="rounded-checkbox">
                                                <input type="checkbox" id="checkbox-alface" />
                                                <label for="checkbox-alface"></label>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 zeroed-col">
                                            <label for="checkbox-alface" class="menu-list-title">Alface</label>
                                        </div>
                                        <div class="col-xl-1 zeroed-col">
                                            <a href="" class="menu-list-edit-item">
                                                <i class="fa fa-pencil-square main-icon-size"></i>
                                            </a>
                                        </div>
                                        <div class="col-xl-1 zeroed-col">
                                            <a href="" class="menu-list-delete-item">
                                                <i class="fa fa-trash-o main-icon-size"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <!-- list item -->
                                <li>
                                    <div class="row menu-list-row">
                                        <div class="col-xl-2 zeroed-col menu-list-checkbox-bloc">
                                            <div class="rounded-checkbox">
                                                <input type="checkbox" id="checkbox-tomate" />
                                                <label for="checkbox-tomate"></label>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 zeroed-col">
                                            <label for="checkbox-tomate" class="menu-list-title">Tomate</label>
                                        </div>
                                        <div class="col-xl-1 zeroed-col">
                                            <a href="" class="menu-list-edit-item">
                                                <i class="fa fa-pencil-square main-icon-size"></i>
                                            </a>
                                        </div>
                                        <div class="col-xl-1 zeroed-col">
                                            <a href="" class="menu-list-delete-item">
                                                <i class="fa fa-trash-o main-icon-size"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <!-- list item -->
                                <li>
                                    <div class="row menu-list-row">
                                        <div class="col-xl-2 zeroed-col menu-list-checkbox-bloc">
                                            <div class="rounded-checkbox">
                                                <input type="checkbox" id="checkbox-beterraba" />
                                                <label for="checkbox-beterraba"></label>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 zeroed-col">
                                            <label for="checkbox-beterraba" class="menu-list-title">Beterraba</label>
                                        </div>
                                        <div class="col-xl-1 zeroed-col">
                                            <a href="" class="menu-list-edit-item">
                                                <i class="fa fa-pencil-square main-icon-size"></i>
                                            </a>
                                        </div>
                                        <div class="col-xl-1 zeroed-col">
                                            <a href="" class="menu-list-delete-item">
                                                <i class="fa fa-trash-o main-icon-size"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3">
        <div class="row">
            <div class="col-xl-12 custom-title-card-bloc">
                <div class="custom-title-card grey-card-bg custom-card-padding-2">
                    <h6>Número de confirmações</h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="custom-card main-card-bg main-card-padding confirmed-card">
                    <div class="row">
                        <div class="col-xl-12">
                            <p>05/02/2021</p>
                        </div>
                        <div class="col-xl-12">
                            <div>
                                <h6><i class="fa fa-circle active"></i> 14 Confirmados</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="custom-card main-card-bg main-card-padding confirmed-card">
                    <div class="row">
                        <div class="col-xl-12">
                            <p>05/02/2021</p>
                        </div>
                        <div class="col-xl-12">
                            <div>
                                <h6><i class="fa fa-circle pending"></i> 26 Confirmados</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="custom-card main-card-bg main-card-padding confirmed-card">
                    <div class="row">
                        <div class="col-xl-12">
                            <p>05/02/2021</p>
                        </div>
                        <div class="col-xl-12">
                            <div>
                                <h6><i class="fa fa-circle inative"></i> 19 Confirmados</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3">
        <div class="row">
            <div class="col-xl-12 custom-title-card-bloc">
                <div class="custom-title-card grey-card-bg-2 custom-card-padding-2">
                    <h6>Menus confirmados</h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="accordion custom-card main-card-bg custom-card-padding-1" id="accordion_menu-dia-0402">
                    <a class="custom-card-header" data-toggle="collapse" data-target="#collapse_menu-dia-0402" aria-expanded="true" aria-controls="accordion_menu-dia-0402">
                        <div class="custom-card-min-header" id="headingOne">
                            <h6>
                                <i class="fa fa-circle active"></i> 05/02/2021
                                <span class="custom-collapse-arrow"></span>
                            </h6>
                        </div>
                    </a>
                    <div id="collapse_menu-dia-0402" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_menu-dia-0402">
                        <div class="card-body">
                            <ul class="">
                                <li>
                                    <p>16 Saladas</p>
                                </li>
                                <li>
                                    <p>14 Acompanhamentos</p>
                                </li>
                                <li>
                                    <p>12 Carnes</p>
                                </li>
                                <li>
                                    <p>15 Sucos</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="accordion custom-card main-card-bg custom-card-padding-1" id="accordion_menu-dia-0502">
                    <a class="custom-card-header" data-toggle="collapse" data-target="#collapse_menu-dia-0502" aria-expanded="true" aria-controls="accordion_menu-dia-0502">
                        <div class="custom-card-min-header" id="headingOne">
                            <h6>
                                04/02/2021
                                <span class="custom-collapse-arrow"></span>
                            </h6>
                        </div>
                    </a>
                    <div id="collapse_menu-dia-0502" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_menu-dia-0502">
                        <div class="card-body">
                            <ul class="">
                                <li>
                                    <p>16 Saladas</p>
                                </li>
                                <li>
                                    <p>14 Acompanhamentos</p>
                                </li>
                                <li>
                                    <p>12 Carnes</p>
                                </li>
                                <li>
                                    <p>15 Sucos</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="accordion custom-card main-card-bg custom-card-padding-1" id="accordion_menu-dia-0602">
                    <a class="custom-card-header" data-toggle="collapse" data-target="#collapse_menu-dia-0602" aria-expanded="true" aria-controls="accordion_menu-dia-0602">
                        <div class="custom-card-min-header" id="headingOne">
                            <h6>
                                05/02/2021
                                <span class="custom-collapse-arrow"></span>
                            </h6>
                        </div>
                    </a>
                    <div id="collapse_menu-dia-0602" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_menu-dia-0602">
                        <div class="card-body">
                            <ul class="">
                                <li>
                                    <p>16 Saladas</p>
                                </li>
                                <li>
                                    <p>14 Acompanhamentos</p>
                                </li>
                                <li>
                                    <p>12 Carnes</p>
                                </li>
                                <li>
                                    <p>15 Sucos</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="accordion custom-card main-card-bg custom-card-padding-1" id="accordion_menu-dia-0702">
                    <a class="custom-card-header" data-toggle="collapse" data-target="#collapse_menu-dia-0702" aria-expanded="true" aria-controls="accordion_menu-dia-0702">
                        <div class="custom-card-min-header" id="headingOne">
                            <h6>
                                05/02/2021
                                <span class="custom-collapse-arrow"></span>
                            </h6>
                        </div>
                    </a>
                    <div id="collapse_menu-dia-0702" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_menu-dia-0702">
                        <div class="card-body">
                            <ul class="">
                                <li>
                                    <p>16 Saladas</p>
                                </li>
                                <li>
                                    <p>14 Acompanhamentos</p>
                                </li>
                                <li>
                                    <p>12 Carnes</p>
                                </li>
                                <li>
                                    <p>15 Sucos</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- section for modals -->
    <div class="modal fade" id="modal_add-menu" tabindex="-1" aria-labelledby="modal_add-menuLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="custom-modal-header">
                    <h5></h5>
                    <a class="close custom-modal-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">

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