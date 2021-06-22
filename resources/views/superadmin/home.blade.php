@extends('superadmin.layouts.default')


@section('title')
Home -
@parent
@stop

@section('content')

<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="main-menu" role="tabpanel" aria-labelledby="main-menu-tab">
        <div class="row">
            <div class="col-xl-3">
                <div class="calendar-card-wrapper">
                    <div class="custom-card dark-card-bg main-card-padding main-card-header">
                        <div class="row">
                            <div class="col-xl-12 custom-card-header-bloc">
                                <h6 class="custom-card-header-title">Selecione o dia que deseja acompanhar</h6>
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
                            <th>Sed</th>
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
                                echo '<td><button type="button" class="date calendar-bubble-day" onclick="select_day(';
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
                </div>
            </div>
            <div class="col-xl-3">
                @if(!$justifications->isEmpty())
                <div class="main-card-wrapper">
                    <div class="justification-main-card">
                        <div class="custom-card dark-card-bg main-card-padding main-card-header">
                            <div class="row">
                                <div class="col-xl-12 custom-card-header-bloc">
                                    <h6 class="custom-card-header-title">Acompanhar justificativa</h6>
                                </div>
                            </div>
                        </div>
                <div id="justifications">
                  @foreach($justifications as $justification)
                    <div class="mb-4">
                        <div class="justification-header">
                            <a class="" data-toggle="collapse" href="#justification-collapse-{{$justification['id']}}" role="button" aria-expanded="false" aria-controls="justification-collapse-{{$justification['id']}}">
                                <h6 class="justification-email">{{$justification['user']['email']}}</h6>
                                <div class="row" style="justify-content: center;">
                                    <div class="col-lg-2" style="padding-right: 0px; text-align: right;">
                                        <i class="fa fa-circle active">
                                        </i>
                                    </div>
                                    <div class="col-lg-6">
                                        <p>justificativa aceita<br>
                                        por (Nome Arms)</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="collapse multi-collapse justification-collapse-body" id="justification-collapse-{{$justification['id']}}">
                            <p>{{$justification['description']}}
                            </p>
                            <div class="check-justification-bloc">
                                <input type="checkbox" id="_checkbox" style="display: none;">
                                <label for="_checkbox">
                                  <div id="tick_mark"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                  @endforeach
                </div>
                </div>
                </div>
                @else
                <div class="main-card-wrapper">
                    <div class="custom-card dark-card-bg main-card-padding main-card-header">
                        <div class="row">
                            <div class="col-xl-12 custom-card-header-bloc">
                                <h6 class="custom-card-header-title">Acompanhar justificativa</h6>
                            </div>
                        </div>
                    </div>
                    <h6 class="no-justification">Nenhuma justificativa a ser exibida.</h6>
                </div>
                @endif
                <input type="hidden" id="month_value" name="month_value">
                <input type="hidden" id="day_value" name="day_value">
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
                        <p>Início</p>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                </div>
                            </div>
                            <input type="date" class="form-control fc-datepicker" id="from_date" name="from_date" autocomplete="off" placeholder="MM/DD/AAAA" style="border: 1px solid #93A8E5">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="wd-200 mg-b-20" style="width: 100%">
                        <p>Final</p>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                </div>
                            </div>
                            <input type="date" class="form-control" id="to_date" name="to_date" autocomplete="off" placeholder="MM/DD/AAAA" style="border: 1px solid #93A8E5">
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
<!-- 
section for modals 
-->

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
@endsection

@section('styles')
<style type="text/css">
  /* #date-2021-05-20{
    background-color: green;
  } */


</style>
@stop


@section('scripts')
<script>
    $(document).ready(function(){
    var dates = {!! json_encode($confirmed_menus->toArray()) !!};
        $.each(dates, function(index, item){
            $("#date-"+item).css("background-color", "#28B43C");
        });
    });
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

    
    // alert(day);
    if(month < 10) month = '0'+month;
    if(day < 10) day = '0'+day; 
    // $( "#date-"+year+"-"+month+"-"+day ).addClass( "menu-selected" );
    var date = year+'-'+month+'-'+day;
    $('#justifications').empty();
    $.ajax({
        type: "GET",
        url: "{{URL::action('SuperAdmin\HomeController@getJustifications')}}",
        data: {
            date: date,
        },
        success: function (data) {
          
            if(data[0].length > 0){
                $.each(data[0], function(index, item){

                    // $('#justifications').append(
                    //     "<div class='mb-4'><div class='justification-header'><a data-toggle='collapse' href='#justification-collapse-"+item.id+"' role='button' aria-expanded='false' aria-controls='justification-collapse-"+item.id+"'><h6 class='justification-email'>"+item.user.email+"</h6><div class='row' style='justify-content: center;'><div class='col-lg-2' style='padding-right: 0px; text-align: right;'><i class='fa fa-circle active'></i></div><div class='col-lg-6'><p>justificativa aceita<br>por (Nome Arms)</p></div></div></a></div><div class='collapse multi-collapse justification-collapse-body' id='justification-collapse-"+item.id+"'><p>"+item.description+"</p><div class='check-justification-bloc'><input type='checkbox' id='_checkbox' style='display: none;'><label for='_checkbox'><div id='tick_mark'></div></label></div></div></div>" 
                    // );
                    $('#justifications').append(
                        "<div class='justification-main-card'><div class='mb-4'><div class='justification-header'><a data-toggle='collapse' href='#justification-collapse-"+item.id+"' role='button' aria-expanded='false' aria-controls='justification-collapse-"+item.id+"'><h6 class='justification-email'>"+item.user.email+"</h6><div class='row' style='justify-content: center;'><div class='col-lg-2' style='padding-right: 0px; text-align: right;'><i class='fa fa-circle active'></i></div><div class='col-lg-6'><p>justificativa aceita<br>por (Nome Arms)</p></div></div></a></div><div class='collapse multi-collapse justification-collapse-body' id='justification-collapse-"+item.id+"'><p>"+item.description+"</p><div class='check-justification-bloc'><input type='checkbox' id='_checkbox' style='display: none;'><label for='_checkbox'><div id='tick_mark'></div></label></div></div></div></div>" 
                    );

                });
            }
            else{
                // <div class="main-card-wrapper">
                //     <div class="custom-card dark-card-bg main-card-padding main-card-header">
                //         <div class="row">
                //             <div class="col-xl-12 custom-card-header-bloc">
                //                 <h6 class="custom-card-header-title">Acompanhar justificativa</h6>
                //             </div>
                //         </div>
                //     </div>
                //     <h6 class="no-justification">Nenhuma justificativa a ser exibida.</h6>
                // </div>



                //             <div class="col-xl-12 custom-card-header-bloc">
                //                 <h6 class="custom-card-header-title">Acompanhar justificativa</h6>
                //             </div>




                $('#justifications').append(
                    "<h6 class='no-justification'>Nenhuma justificativa a ser exibida.</h6>"      
                ); 

                // $('#justifications').append(
                //     "<div class='main-card-wrapper'><div class='custom-card dark-card-bg main-card-padding main-card-header'><div class='row'><div class='col-xl-12 custom-card-header-bloc'><h6 class='custom-card-header-title'>Acompanhar justificativa</h6></div></div></div><h6 class='no-justification'>Nenhuma justificativa a ser exibida.</h6></div>"      
                // ); 
            }
        }
    });

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
		    url: "{{URL::action('SuperAdmin\HomeController@dataDetailMenu')}}",
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
		    url: "{{URL::action('SuperAdmin\HomeController@dataDetailMenu')}}",
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
		    url: "{{URL::action('SuperAdmin\HomeController@dataDetailMenu')}}",
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
            url: "{{URL::action('SuperAdmin\HomeController@dataDetailMenu')}}",
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
            url: "{{URL::action('SuperAdmin\HomeController@dataDetailMenu')}}",
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