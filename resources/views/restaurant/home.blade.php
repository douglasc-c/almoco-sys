@extends('restaurant.layouts.default')

@section('title')
Home -
@parent
@stop

@section('content')

<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="main-menu" role="tabpanel" aria-labelledby="main-menu-tab">
        <form method="POST" action="{{URL::action('Restaurant\MenuController@createMenu')}}">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-xl-3">
                    <div class="calendar-card-wrapper">
                        <div class="custom-card dark-card-bg main-card-padding main-card-header">
                            <div class="row">
                                <div class="col-xl-12 custom-card-header-bloc">
                                    <h6 class="custom-card-header-title">dia em que deseja incluir o menu</h6>
                                </div>
                            </div>
                        </div>
                        <div class="calendar-month-wrapper">
                            <button style="display: none;" data-toggle="collapse"></button>
                            <a data-toggle="collapse" data-target="#collapseMonth" aria-expanded="true" aria-controls="collapseMonth" class="collapse-calendar-btn">
                                <div class="calendar-header-box">
                        @php 
                            $today = today();
                                    echo '<h5 class="w3-text-teal calendar-month"><img class="main-icon-card-header-calendar" src="assets/admin-theme/images/restaurant/home/calendar-icon.svg"><span id="text_month">' . $today->format('F Y') . '<span class="custom-collapse-arrow-2"></span></span></h5>
                                </div>
                            </a>
                            <div class="collapse collapse-show-month-body show" id="collapseMonth">';

                                $tempDate = Carbon\Carbon::createFromDate($today->year, $today->month, 1);

                                echo '<table border="1" class = "w3-table w3-boarder w3-striped main-calendar">
                                    <thead><tr class="w3-theme">
                                    <th>Dom</th>
                                    <th>Seg</th>
                                    <th>Ter</th>
                                    <th>Qua</th>
                                    <th>Qui</th>
                                    <th>Sex</th>
                                    <th>Sáb</th>
                                    </tr></thead>';

                                $skip = $tempDate->dayOfWeek;


                                for($i = 0; $i < $skip; $i++)
                                {
                                    $tempDate->subDay();
                                }


                                //loops through month
                                do
                                {
                                    echo '<tr>';
                                    //loops through each week
                                    for($i=0; $i < 7; $i++)
                                    {
                                        echo '<td><button type="button" class="date calendar-bubble-day" onclick="selectBubble(this.id);select_day(';
                                        echo $tempDate->day;
                                        echo ','; 
                                        echo $tempDate->month;
                                        echo ','; 
                                        echo $tempDate->year;
                                        echo ')"';
                                        echo 'id="date-';
                                        echo $tempDate->year; 
                                        echo '-'; 
                                        if($tempDate->month < 10) echo '0';
                                        echo $tempDate->month;
                                        echo '-'; 
                                        if($tempDate->day < 10) echo '0';
                                        echo $tempDate->day;
                                        echo  '">';

                                        echo $tempDate->day;

                                        echo '</button></td>';

                                        $tempDate->addDay();
                                    }
                                    echo '</tr>';

                                }while($tempDate->month == $today->month);

                            echo '</table>';
                        @endphp
                            </div>
                        </div>
                        <div class="summary-card">
                            <div class="row">
                                <div class="col-xl-12">
                                    <p><i class="fa fa-circle status-sucess"></i> MENU JÁ ADICIONADO</p>
                                    <hr style="color: #fff; width: 100%; margin: 10px 0;">
                                    <p><i class="fa fa-circle status-yellow"></i> MENU SELECIONADO PARA ADICIONAR</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="main-card-wrapper">
                        <div class="custom-card dark-card-bg main-card-padding main-card-header">
                            <div class="row">
                                <div class="col-xl-12 custom-card-header-bloc">
                                    <h6 class="custom-card-header-title">Adicionar menu</h6>
                                </div>
                            </div>
                        </div>
                        
                            <div class="row">
                                <div class="col-xl-12" id="wrapper-categories">
                                    @foreach($categoriesAll as $category)
                                    <div class="accordion custom-card main-card-bg-secondary custom-card-padding-1 main-category-card">
                                        <a class="custom-card-header" data-toggle="collapse" data-target="#collapse_add-{{$category['name']}}" aria-expanded="true">
                                            <div class="custom-card-min-header" id="headingOne">
                                                <h6>
                                                    <img class="main-icon-card-header" src="assets/admin-theme/images/restaurant/menu/{{$category['name']}}.svg">
                                                    {{$category['name']}}
                                                    <span class="custom-collapse-arrow"></span>
                                                </h6>
                                            </div>
                                        </a>
                                        <div id="collapse_add-{{$category['name']}}" class="collapse" aria-labelledby="headingOne" data-parent="#wrapper-categories">
                                            <div class="card-body card-body-menu">
                                                <ul class="menu-ul">
                                                    <!-- list item -->
                                                    @foreach($category['itens'] as $item)
                                                        <li>
                                                            <div class="row menu-list-row">
                                                                <div class="col-xl-2 zeroed-col menu-list-checkbox-bloc" style="align-self: center;">
                                                                    <div class="rounded-checkbox">
                                                                        <input type="checkbox" id="{{$item->name}}" name="checkbox[{{$item->name}}]"/>
                                                                        <label for="{{$item->name}}"></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-7 zeroed-col">
                                                                    <label for="{{$item->name}}" class="menu-list-title">{{$item->name}}</label>
                                                                    <p class="mb-0">{{$item->description}}</p>
                                                                </div>
                                                                <div class="col-xl-1 zeroed-col">
                                                                    <a href="" class="menu-list-edit-item">
                                                                       <i class="fa fa-pencil-square main-icon-size"></i>
                                                                    </a>
                                                                </div>
<!--                                                                 <div class="col-xl-1 zeroed-col">
                                                                    <a href="" class="menu-list-delete-item">
                                                                       <i class="fa fa-trash-o main-icon-size"></i>
                                                                    </a>
                                                                </div> -->
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 collapse-btn-bloc">
                                                    <button type="button" class="main-btn main-btn-color" data-toggle="modal" data-target="#newFood{{$category['name']}}">Adicionar Novo</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal add food  -->
                                    <div class="modal fade" id="newFood{{$category['name']}}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content radius-30">
                                                <div class="modal-header border-bottom-0" style="align-self: center;">
                                                    <h3 class="text-center">Cadastrar Novo Alimento</h3>
                                                    <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </a>
                                                </div>
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertError_{{$category['name']}}" style="display: none;">
                                                    Alimento já cadastrado
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body p-5">
                                                    <form method="POST" id="createProduct{{$category['name']}}" action="{{URL::action('Restaurant\FoodController@createFood')}}">
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <label>Nome do alimento</label>
                                                            <input type="text" name="name" id="name_{{$category['name']}}" class="form-control form-control-lg radius-30" placeholder="Digite o nome do alimento"/>
                                                        </div>
<!--                                                         <div class="form-group">
                                                            <label>Descrição</label>
                                                            <input type="text" name="description" class="form-control form-control-lg radius-30" placeholder=""/>
                                                        </div> -->
                                                        <div class="form-group">
                                                            <label>Categoria</label>
                                                            <input type="text" name="category" class="form-control form-control-lg radius-30" value="{{$category['name']}}" readonly/>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="button" class="btn btn-light radius-30 btn-lg btn-block" onclick="newProduct('{{$category['name']}}')">Cadastrar</button>
                                                        </div>
                                                        <hr/>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                        <input type="hidden" id="month_value" name="month_value">
                        <input type="hidden" id="day_value" name="day_value">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="main-btn main-save-btn-green">Salvar Menu</button>
                            </div>
                        </div>
                    </div>
        </form>
                </div>
            <div class="col-xl-3">
                <div class="main-card-wrapper">
                    <div class="custom-card dark-card-bg main-card-padding main-card-header">
                        <div class="row">
                            <div class="col-xl-12 custom-card-header-bloc">
                                <h6 class="custom-card-header-title">Número de confirmações</h6>
                            </div>
                        </div>
                    </div>
                    <!-- confirmation -->
                    <div class="confirmation-main-box">
                        <div class="confirmation-box-1">
                            <p>{{Carbon\Carbon::now()->startOfWeek()->format('d/m/Y')}} <i class="fa fa-circle active"></i></p>
                        </div>
                        <div class="confirmation-box-2">
                            <p><span> {{$orders_confirmed['monday']}} </span> Confirmados</p>
                        </div>
                    </div>
                    <!-- confirmation -->
                    <div class="confirmation-main-box">
                        <div class="confirmation-box-1">
                            <p> {{Carbon\Carbon::now()->startOfWeek()->addDays(1)->format('d/m/Y')}} <i class="fa fa-circle active"></i></p>
                        </div>
                        <div class="confirmation-box-2">
                            <p><span> {{$orders_confirmed['tuesday']}} </span> Confirmados</p>
                        </div>
                    </div>
                    <!-- confirmation -->
                    <div class="confirmation-main-box">
                        <div class="confirmation-box-1">
                            <p> {{Carbon\Carbon::now()->startOfWeek()->addDays(2)->format('d/m/Y')}} <i class="fa fa-circle active"></i></p>
                        </div>
                        <div class="confirmation-box-2">
                            <p><span> {{$orders_confirmed['wednesday']}} </span> Confirmados</p>
                        </div>
                    </div>
                    <!-- confirmation -->
                    <div class="confirmation-main-box">
                        <div class="confirmation-box-1">
                            <p> {{Carbon\Carbon::now()->startOfWeek()->addDays(3)->format('d/m/Y')}} <i class="fa fa-circle active"></i></p>
                        </div>
                        <div class="confirmation-box-2">
                            <p><span> {{$orders_confirmed['thursday']}} </span> Confirmados</p>
                        </div>
                    </div>
                    <!-- confirmation -->
                    <div class="confirmation-main-box">
                        <div class="confirmation-box-1">
                            <p> {{Carbon\Carbon::now()->startOfWeek()->addDays(4)->format('d/m/Y')}} <i class="fa fa-circle active"></i></p>
                        </div>
                        <div class="confirmation-box-2">
                            <p><span> {{$orders_confirmed['friday']}} </span> Confirmados</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="main-card-wrapper" id="collapse-wrapper">
                    <div class="custom-card dark-card-bg main-card-padding main-card-header">
                        <div class="row">
                            <div class="col-xl-12 custom-card-header-bloc">
                                <h6 class="custom-card-header-title">Menus confirmados</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="accordion-confirmed-menu">
                                <div class="accordion custom-card custom-card-padding-1" id="accordion_menu-monday">
                                    <a class="custom-card-header" data-toggle="collapse" data-target="#collapse_menu-monday" aria-expanded="true" aria-controls="accordion_menu-monday">
                                        <div class="custom-card-min-header" id="headingOne">
                                            <h6>
                                                {{-- <i class="fa fa-circle active"></i>  --}}
                                                {{Carbon\Carbon::now()->startOfWeek()->format('d/m/Y')}} - Segunda
                                                <span class="custom-collapse-arrow"></span>
                                            </h6>
                                        </div>
                                    </a>
                                    <div id="collapse_menu-monday" class="collapse" aria-labelledby="headingOne" data-parent="#collapse-wrapper">
                                        
                                        <div class="card-body">
                                            <ul class="">
                                                @foreach($monday as $category)
                                                <li>
                                                    <p>{{$category['amount']}} - {{$category['name']}}</p>
                                                </li>
                                                @endforeach
                                            </ul>
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <a href="" class="main-btn main-btn-color main-btn-width" data-toggle="modal" data-target="#modal_monday">Ver Detalhes</a>
                                                </div>
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="accordion custom-card custom-card-padding-1" id="accordion_menu-dia-0402">
                                <div class="accordion-confirmed-menu">
                                    <a class="custom-card-header" data-toggle="collapse" data-target="#collapse_menu-dia-0402" aria-expanded="true" aria-controls="accordion_menu-dia-0402" data-target="#collapse_menu-dia-0402">
                                        <div class="custom-card-min-header" id="headingOne">
                                            <h6>
                                                {{Carbon\Carbon::now()->startOfWeek()->addDays(1)->format('d/m/Y')}}  - Terça
                                                <span class="custom-collapse-arrow"></span>
                                            </h6>
                                        </div>
                                    </a>
                                    <div id="collapse_menu-dia-0402" class="collapse" aria-labelledby="headingOne" data-parent="#collapse-wrapper">
                                        <div class="card-body">
                                                <ul class="">
                                                    @foreach($tuesday as $category)
                                                    <li>
                                                        <p>{{$category['amount']}} - {{$category['name']}}</p>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <a href="" class="main-btn main-btn-color main-btn-width" data-toggle="modal" data-target="#modal_tuesday">Ver Detalhes</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="accordion custom-card custom-card-padding-1" id="accordion_menu-dia-0502">
                                <div class="accordion-confirmed-menu">
                                    <a class="custom-card-header" data-toggle="collapse" data-target="#collapse_menu-dia-0502" aria-expanded="true" aria-controls="accordion_menu-dia-0502" data-target="collapse_menu-dia-0502">
                                        <div class="custom-card-min-header" id="headingOne">
                                            <h6>
                                                {{Carbon\Carbon::now()->startOfWeek()->addDays(2)->format('d/m/Y')}}  - Quarta
                                                <span class="custom-collapse-arrow"></span>
                                            </h6>
                                        </div>
                                    </a>
                                    <div id="collapse_menu-dia-0502" class="collapse" aria-labelledby="headingOne" data-parent="#collapse-wrapper">
                                        <div class="card-body">
                                            <ul class="">
                                                @foreach($wednesday as $category)
                                                <li>
                                                    <p>{{$category['amount']}} - {{$category['name']}}</p>
                                                </li>
                                                @endforeach
                                            </ul>
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <a href="" class="main-btn main-btn-color main-btn-width" data-toggle="modal" data-target="#modal_wednesday">Ver Detalhes</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="accordion custom-card custom-card-padding-1" id="accordion_menu-dia-0402">
                                <div class="accordion-confirmed-menu">
                                    <a class="custom-card-header" data-toggle="collapse" data-target="#collapse_menu-yesterday" aria-expanded="true" aria-controls="collapse_menu-yesterday">
                                        <div class="custom-card-min-header" id="headingOne">
                                            <h6>
                                                {{Carbon\Carbon::now()->startOfWeek()->addDays(3)->format('d/m/Y')}}  - Quinta
                                                <span class="custom-collapse-arrow"></span>
                                            </h6>
                                        </div>
                                    </a>
                                    <div id="collapse_menu-yesterday" class="collapse" aria-labelledby="headingOne" data-parent="#collapse-wrapper">
                                        <div class="card-body">
                                            <ul class="">
                                                @foreach($thursday as $category)
                                                <li>
                                                    <p>{{$category['amount']}} - {{$category['name']}}</p>
                                                </li>
                                                @endforeach
                                            </ul>
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <a href="" class="main-btn main-btn-color main-btn-width" data-toggle="modal" data-target="#modal_thursday">Ver Detalhes</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="accordion custom-card custom-card-padding-1" id="accordion_menu-dia-0402">
                                <div class="accordion-confirmed-menu">
                                    <a class="custom-card-header" data-toggle="collapse" data-target="#collapse_menu-before-yesterday" aria-expanded="true" aria-controls="collapse_menu-before-yesterday">
                                        <div class="custom-card-min-header" id="headingOne">
                                            <h6>
                                                {{Carbon\Carbon::now()->startOfWeek()->addDays(4)->format('d/m/Y')}}  - Sexta
                                                <span class="custom-collapse-arrow"></span>
                                            </h6>
                                        </div>
                                    </a>
                                    <div id="collapse_menu-before-yesterday" class="collapse" aria-labelledby="headingOne" data-parent="#collapse-wrapper">
                                        <div class="card-body">
                                            <ul class="">
                                                @foreach($friday as $category)
                                                <li>
                                                    <p>{{$category['amount']}} - {{$category['name']}}</p>
                                                </li>
                                                @endforeach
                                            </ul>
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <a href="" class="main-btn main-btn-color main-btn-width" data-toggle="modal" data-target="#modal_friday">Ver Detalhes</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- graph tab -->
    <div class="tab-pane fade" id="main-graph" role="tabpanel" aria-labelledby="graph-menu-tab">
            <div class="row">
                <div class="col-md-3">
                    <div class="wd-200 mg-b-20" style="width: 100%">
                        <h6 style="color: #333F68;">Data de Início:</h6>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                </div>
                            </div>
                            <input type="date" class="form-control fc-datepicker datepicker-date" id="from_date" name="from_date" autocomplete="off" placeholder="MM/DD/AAAA" style="border: 1px solid #93A8E5">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="wd-200 mg-b-20" style="width: 100%">
                        <h6 style="color: #333F68;">Data Final</h6>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                </div>
                            </div>
                            <input type="date" class="form-control datepicker-date" id="to_date" name="to_date" autocomplete="off" placeholder="MM/DD/AAAA" style="border: 1px solid #93A8E5">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="submit" id="get_filter" class="main-btn main-btn-color main-btn-width" style="margin-top: 34px">Filtrar</button>
                </div>
            </div>
        <div class="row">
                <canvas id="mycanvas" style="max-width: 800px;"></canvas>
        </div>
    </div>
</div>
<style type="text/css">
    .datepicker-date {
        color: #333F68;
    }
</style>
<!-- 
section for modals 
-->
    <!-- modal addmenu -->
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

    <!-- MONDAY modal add food  -->
        <div class="modal fade" id="modal_monday" tabindex="-1" aria-labelledby="modal_add-menuLabel" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content radius-30">
                    <div class="modal-header border-bottom-0" style="align-self: center;">
                        <h3 class="text-center">{{Carbon\Carbon::now()->startOfWeek()->format('d/m/Y')}} - <small>Segunda</small></h3>
                        <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <div class="modal-body modal-body-show-menu">
                        @foreach($categories_all as $category)
                            <h4>{{$category->name}}</h4>
                            <div id="result_body_monday_{{$category->id}}"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    <!-- TUESDAY modal category -->
        <div class="modal fade" id="modal_tuesday" tabindex="-1" aria-labelledby="modal_add-menuLabel" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content radius-30">
                    <div class="modal-header border-bottom-0" style="align-self: center;">
                        <h3 class="text-center">{{Carbon\Carbon::now()->startOfWeek()->format('d/m/Y')}} - <small>Terça</small></h3>
                        <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <div class="modal-body modal-body-show-menu">
                        @foreach($categories_all as $category)
                            <h4>{{$category->name}}</h4>
                            <div id="result_body_tuesday_{{$category->id}}"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    <!-- WEEDNESDAY modal category -->
        <div class="modal fade" id="modal_wednesday" tabindex="-1" aria-labelledby="modal_add-menuLabel" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content radius-30">
                    <div class="modal-header border-bottom-0" style="align-self: center;">
                        <h3 class="text-center">{{Carbon\Carbon::now()->startOfWeek()->format('d/m/Y')}} - <small>Quarta</small></h3>
                        <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <div class="modal-body modal-body-show-menu">
                        @foreach($categories_all as $category)
                            <h4>{{$category->name}}</h4>
                            <div id="result_body_wednesday_{{$category->id}}"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    <!-- THURSDAY modal category  -->
        <div class="modal fade" id="modal_thursday" tabindex="-1" aria-labelledby="modal_add-menuLabel" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content radius-30">
                    <div class="modal-header border-bottom-0" style="align-self: center;">
                        <h3 class="text-center">{{Carbon\Carbon::now()->startOfWeek()->format('d/m/Y')}} - <small>Quinta</small></h3>
                        <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <div class="modal-body modal-body-show-menu">
                        @foreach($categories_all as $category)
                            <h4>{{$category->name}}</h4>
                            <div id="result_body_thursday_{{$category->id}}"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    <!-- FRIDAY modal category -->
        <div class="modal fade" id="modal_friday" tabindex="-1" aria-labelledby="modal_add-menuLabel" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content radius-30">
                    <div class="modal-header border-bottom-0" style="align-self: center;">
                        <h3 class="text-center">{{Carbon\Carbon::now()->startOfWeek()->format('d/m/Y')}} - <small>Sexta</small></h3>
                        <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <div class="modal-body modal-body-show-menu">
                        @foreach($categories_all as $category)
                            <h4>{{$category->name}}</h4>
                            <div id="result_body_friday_{{$category->id}}"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    <!-- end modal category resume -->
    <input type="hidden" id="_token" value=" {{ csrf_token() }} ">
    <input type="hidden" id="date_year" value=" {{ $date['year'] }} ">
    <input type="hidden" id="date_month" value=" {{ $date['month']}} ">
    <input type="hidden" id="date_day" value=" {{ $date['day'] }} ">
@endsection

@section('styles')

@stop


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script>
    $(document).ready(function(){
        var dates = 'date-'+$("#date-"+date_year).val();
       alert('teste');
    });
    // $("#date-"+item).css("background-color", "#28B43C");
</script>
<script>
        $("#get_filter").on('click', function(){
            
            var from_date = $("#from_date").val();
            var to_date = $("#to_date").val();
    
            var ctx_live = document.getElementById("mycanvas");
            var myChart = new Chart(ctx_live, {
            type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                    data: [],
                    borderWidth: 1,
                    borderColor:'#ADBBE0',
                    label: 'liveCount',
                    }]
                },
                options: {
                    responsive: true,
                    title: {
                    display: true,
                    text: "",
                    },
                    legend: {
                    display: false
                    },
                    scales: {
                    yAxes: [{
                        ticks: {
                        beginAtZero: true,
                        }
                    }]
                    }
                }
                });
                // end graph
            $.ajax({
                type: "GET",
                url: "{{URL::action('Restaurant\MenuController@getReportData')}}",
                data: {
                    from_date: from_date,
                    to_date: to_date,
                },
                success: function (data) {

                    $.each(data[0], function(index, item){
                        myChart.data.labels.push(item);
                    });
                    $.each(data[1], function(index, item){
                        myChart.data.datasets[0].data.push(item);
                    });
                    // re-render the chart
                    myChart.update();
                }
            });
        });
            
</script>
<script>
    $(document).ready(function(){
    var dates = {!! json_encode($confirmed_menus->toArray()) !!};
        $.each(dates, function(index, item){
            $("#date-"+item).css("background-color", "#28B43C");
        });
    });
</script>
<script>
    function newProduct(category){
        var cat = category;
        var name = $('#name_'+category).val();
        var description = $('#description_'+category).val();
        var _token = $('#_token').val();

        $.ajax({
		    type: "POST",
		    url: "{{URL::action('Restaurant\FoodController@createFood')}}",
		    data: {
                _token: _token,
                name: name,
                description: description,
                category: cat,
            },
		    success: function (data) {
                if(data['status'] == true) location.reload();

                if(data['status'] == false) {
                    $('#alertError_'+category).show();
                }
                
		    }
		});
    }

</script>
<script>
function select_day(day, month, year){
    $('#day_value').val(day);
    $('#month_value').val(month);
    if(month == 6){
        $('#text_month').text('Junho 2021');
    }else if(month == 5){
        $('#text_month').text('Maio 2021');
    }
    $('#date-'+year+'-'+month+'-'+day).addClass("menu-selected");
}

function selectBubble(id) {
    var bubbles = document.getElementsByClassName('calendar-bubble-day');
    for (var i = 0; i < bubbles.length; i++) {
      bubbles[i].classList.remove('menu-selected');
    }
    document.getElementById(id).classList.add('menu-selected');
}
</script>
<script>
$(document).ready(function(){

    var monday = 'monday';
    var tuesday = 'tuesday';
    var wednesday = 'wednesday';
    var thursday = 'thursday';
    var friday = 'friday';
    

    $('#modal_monday').on('show.bs.modal', function () {

        $.ajax({
		    type: "GET",
		    url: "{{URL::action('Restaurant\MenuController@dataDetailMenu')}}",
		    data: {
                day: monday,
            },
		    success: function (data) {
                if(data.length > 0){
                    $.each(data[0], function(index, item){
                        $('#result_body_monday_'+item.category_id).empty();
                    });
                    $.each(data[0], function(index, item){
                        if(item.amount > 0){
                            $('#result_body_monday_'+item.category_id).append("<p>"+item.amount+" - "+item.name+"</p>");
                        }
                    });
                }
		    }
		});

    });

    $('#modal_tuesday').on('show.bs.modal', function () {

        $.ajax({
		    type: "GET",
		    url: "{{URL::action('Restaurant\MenuController@dataDetailMenu')}}",
		    data: {
                day: tuesday,
            },
		    success: function (data) {
                
                if(data.length > 0){
                    $.each(data[0], function(index, item){
                        $('#result_body_tuesday_'+item.category_id).empty();
                    });
                    $.each(data[0], function(index, item){
                        if(item.amount > 0){
                            $('#result_body_tuesday_'+item.category_id).append("<p>"+item.amount+" - "+item.name+"</p>");
                        }
                    });
                }

		    }
		});

    });
    
    $('#modal_wednesday').on('show.bs.modal', function () {

        $.ajax({
		    type: "GET",
		    url: "{{URL::action('Restaurant\MenuController@dataDetailMenu')}}",
		    data: {
                day: wednesday,
            },
		    success: function (data) {
                if(data.length > 0){
                    $.each(data[0], function(index, item){
                        $('#result_body_wednesday_'+item.category_id).empty();
                    });
                    $.each(data[0], function(index, item){
                        if(item.amount > 0){
                            $('#result_body_wednesday_'+item.category_id).append("<p>"+item.amount+" - "+item.name+"</p>");
                        }
                        
                    });
                }
		    }
		});

    });

    $('#modal_thursday').on('show.bs.modal', function () {

        $.ajax({
            type: "GET",
            url: "{{URL::action('Restaurant\MenuController@dataDetailMenu')}}",
            data: {
                day: thursday,
            },
            success: function (data) {
                if(data.length > 0){
                    $.each(data[0], function(index, item){
                        $('#result_body_thursday_'+item.category_id).empty();
                    });
                    $.each(data[0], function(index, item){
                        if(item.amount > 0){
                            $('#result_body_thursday_'+item.category_id).append("<p>"+item.amount+" - "+item.name+"</p>");
                        }
                    });
                }
            }
        });

    });
    $('#modal_friday').on('show.bs.modal', function () {

        $.ajax({
            type: "GET",
            url: "{{URL::action('Restaurant\MenuController@dataDetailMenu')}}",
            data: {
                day: friday,
            },
            success: function (data) {
                if(data.length > 0){
                    $.each(data[0], function(index, item){
                        $('#result_body_friday_'+item.category_id).empty();
                    });
                    $.each(data[0], function(index, item){
                        if(item.amount > 0){
                            $('#result_body_friday_'+item.category_id).append("<p>"+item.amount+" - "+item.name+"</p>");
                        }
                    });
                }
            }
        });
    });
    
});
</script>
<script type="text/javascript">
$('[data-toggle="collapse"]').on('click',function(e){
    if ( $(this).parents('.accordion').find('.collapse.show') ){
        var idx = $(this).index('[data-toggle="collapse"]');
        if (idx == $('.collapse.show').index('.collapse')) {
            e.stopPropagation();
        }
    }
});

</script>


@stop