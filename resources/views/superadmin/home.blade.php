@extends('superAdmin.layouts.default')


@section('title')
Home -
@parent
@stop

@section('content')

<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="main-menu" role="tabpanel" aria-labelledby="main-menu-tab">
        <div class="row">
            <div class="col-xl-3">
                <div class="custom-card dark-card-bg main-card-padding">
                    <div class="row">
                        <div class="col-xl-12 custom-card-header-bloc">
                            <h6>Selecione o dia que deseja acompanhar</h6>
                        </div>
                    </div>
                </div>
                <div class="accordion custom-card main-card-bg main-card-padding" id="accordionExample" >
                    <div class="col-xl-12 custom-card-header-bloc">
                        {{-- <h6>Selecione o dia que deseja editar</h6> --}}
                    </div>
                    @php 
                    $today = today();

                    echo '<h3 class="w3-text-teal calendar-month"><span id="text_month">' . $today->format('F Y') . '</span></h3>';

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
            <div class="col-xl-3">
                <div class="custom-card dark-card-bg main-card-padding">
                    <div class="row">
                        <div class="col-xl-12 custom-card-header-bloc">
                            <a href="" class="" data-toggle="modal" data-target="#modal_add-menu">
                                <h6>Acompanhar justificativa</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <div id="justifications">
        <!-- bloco de menu, pode ser adicionado através do modal -->
                @foreach($justifications as $justification)
                <div class="row">
                    <div class="col-xl-12">
                        <div class="accordion custom-card main-card-bg custom-card-padding-1" id="accordion_add-acompanhamento">
                            <a class="custom-card-header" data-toggle="collapse" data-target="#collapse_add-{{$justification['id']}}" aria-expanded="true" aria-controls="collapse_add-acompanhamento">
                                <div class="custom-card-min-header" id="headingOne">
                                    <h6>
                                        {{$justification['user']['email']}}
                                        <span class="custom-collapse-arrow"></span>
                                    </h6>
                                </div>
                            </a>
                            <div id="collapse_add-{{$justification['id']}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_add-acompanhamento">
                                <div class="card-body">
                                    <p>{{$justification['description']}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--   -->
                @endforeach
                </div>
                <input type="hidden" id="month_value" name="month_value">
                <input type="hidden" id="day_value" name="day_value">
            </div>
            <div class="col-xl-3">
                <div class="custom-card dark-card-bg main-card-padding">
                    <div class="row">
                        <div class="col-xl-12 custom-card-header-bloc">
                            <h6>Número de confirmações</h6>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="custom-card main-card-bg main-card-padding confirmed-card">
                            <div class="row">
                                <div class="col-xl-12">
                                    <p>{{Carbon\Carbon::now()->startOfWeek()->format('d/m/Y')}} - Segunda-Feira</p>
                                </div>
                                <div class="col-xl-12">
                                    <div>
                                        <h6></i> {{$orders_confirmed['monday']}} Confirmados</h6>
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
                                    <p>{{Carbon\Carbon::now()->startOfWeek()->addDays(1)->format('d/m/Y')}}  - Terça-Feira</p>
                                </div>
                                <div class="col-xl-12">
                                    <div>
                                        <h6></i> {{$orders_confirmed['tuesday']}} Confirmados</h6>
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
                                    <p>{{Carbon\Carbon::now()->startOfWeek()->addDays(2)->format('d/m/Y')}}  - Quarta-Feira</p>
                                </div>
                                <div class="col-xl-12">
                                    <div>
                                        <h6></i> {{$orders_confirmed['wednesday']}} Confirmados</h6>
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
                                    <p>{{Carbon\Carbon::now()->startOfWeek()->addDays(3)->format('d/m/Y')}}  - Quinta-Feira</p>
                                </div>
                                <div class="col-xl-12">
                                    <div>
                                        <h6></i> {{$orders_confirmed['thursday']}} Confirmados</h6>
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
                                    <p>{{Carbon\Carbon::now()->startOfWeek()->addDays(4)->format('d/m/Y')}}  - Sexta-Feira</p>
                                </div>
                                <div class="col-xl-12">
                                    <div>
                                        <h6></i> {{$orders_confirmed['friday']}} Confirmados</h6>
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
                        <div class="accordion custom-card main-card-bg custom-card-padding-1" id="accordion_menu-monday">
                            <a class="custom-card-header" data-toggle="collapse" data-target="#collapse_menu-monday" aria-expanded="true" aria-controls="accordion_menu-monday">
                                <div class="custom-card-min-header" id="headingOne">
                                    <h6>
                                        {{-- <i class="fa fa-circle active"></i>  --}}
                                        {{Carbon\Carbon::now()->startOfWeek()->format('d/m/Y')}} - Segunda-Feira
                                        <span class="custom-collapse-arrow"></span>
                                    </h6>
                                </div>
                            </a>
                            <div id="collapse_menu-monday" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_menu-monday">
                                
                                <div class="card-body">
                                    <ul class="">
                                        @foreach($monday as $category)
                                        <li>
                                            <p>{{$category['amount']}} - {{$category['name']}}</p>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modal_monday">Detalhes</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="accordion custom-card main-card-bg custom-card-padding-1" id="accordion_menu-dia-0402">
                            <a class="custom-card-header" data-toggle="collapse" data-target="#collapse_menu-dia-0402" aria-expanded="true" aria-controls="accordion_menu-dia-0402">
                                <div class="custom-card-min-header" id="headingOne">
                                    <h6>
                                        {{Carbon\Carbon::now()->startOfWeek()->addDays(1)->format('d/m/Y')}}  - Terça-Feira
                                        <span class="custom-collapse-arrow"></span>
                                    </h6>
                                </div>
                            </a>
                            <div id="collapse_menu-dia-0402" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_menu-dia-0402">
                                <div class="card-body">
                                        <ul class="">
                                            @foreach($tuesday as $category)
                                            <li>
                                                <p>{{$category['amount']}} - {{$category['name']}}</p>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modal_tuesday">Detalhes</a>
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
                                        {{Carbon\Carbon::now()->startOfWeek()->addDays(2)->format('d/m/Y')}}  - Quarta-Feira
                                        <span class="custom-collapse-arrow"></span>
                                    </h6>
                                </div>
                            </a>
                            <div id="collapse_menu-dia-0502" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_menu-dia-0502">
                                <div class="card-body">
                                        <ul class="">
                                            @foreach($wednesday as $category)
                                            <li>
                                                <p>{{$category['amount']}} - {{$category['name']}}</p>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modal_wednesday">Detalhes</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="accordion custom-card main-card-bg custom-card-padding-1" id="accordion_menu-dia-0402">
                            <a class="custom-card-header" data-toggle="collapse" data-target="#collapse_menu-yesterday" aria-expanded="true" aria-controls="collapse_menu-yesterday">
                                <div class="custom-card-min-header" id="headingOne">
                                    <h6>
                                        {{Carbon\Carbon::now()->startOfWeek()->addDays(3)->format('d/m/Y')}}  - Quinta-Feira
                                        <span class="custom-collapse-arrow"></span>
                                    </h6>
                                </div>
                            </a>
                            <div id="collapse_menu-yesterday" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_menu-dia-0402">
                                <div class="card-body">
                                    <ul class="">
                                        @foreach($thursday as $category)
                                        <li>
                                            <p>{{$category['amount']}} - {{$category['name']}}</p>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modal_thursday">Detalhes</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="accordion custom-card main-card-bg custom-card-padding-1" id="accordion_menu-dia-0402">
                            <a class="custom-card-header" data-toggle="collapse" data-target="#collapse_menu-before-yesterday" aria-expanded="true" aria-controls="collapse_menu-before-yesterday">
                                <div class="custom-card-min-header" id="headingOne">
                                    <h6>
                                        {{Carbon\Carbon::now()->startOfWeek()->addDays(4)->format('d/m/Y')}}  - Sexta-Feira
                                        <span class="custom-collapse-arrow"></span>
                                    </h6>
                                </div>
                            </a>
                            <div id="collapse_menu-before-yesterday" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_menu-dia-0402">
                                <div class="card-body">
                                    <ul class="">
                                        @foreach($friday as $category)
                                        <li>
                                            <p>{{$category['amount']}} - {{$category['name']}}</p>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modal_friday">Detalhes</a>
                                </div>
                            </div>
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

        <!-- modal category before tomorrow -->
        <div class="modal fade" id="modal_monday" tabindex="-1" aria-labelledby="modal_add-menuLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="custom-modal-header">
                            <h5></h5>
                            <a class="close custom-modal-close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </a>
                        </div>
                        <div class="modal-body">

                            @foreach($categories_all as $category)
                                <h4>{{$category->name}}</h4>
                                <div id="result_body_monday_{{$category->id}}"></div>
                            @endforeach

                        </div>
                        <div class="modal-footer">
        
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal category resume -->
            <!-- modal category tomorrow -->
            <div class="modal fade" id="modal_tuesday" tabindex="-1" aria-labelledby="modal_add-menuLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="custom-modal-header">
                            <h5></h5>
                            <a class="close custom-modal-close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </a>
                        </div>
                        <div class="modal-body">
                            @foreach($categories_all as $category)
                                <h4>{{$category->name}}</h4>
                                <div id="result_body_tuesday_{{$category->id}}"></div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
        
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal category resume -->
            <!-- modal category today -->
            <div class="modal fade" id="modal_wednesday" tabindex="-1" aria-labelledby="modal_add-menuLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="custom-modal-header">
                            <h5></h5>
                            <a class="close custom-modal-close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </a>
                        </div>
                        <div class="modal-body">
                            @foreach($categories_all as $category)
                                <h4>{{$category->name}}</h4>
                                <div id="result_body_wednesday_{{$category->id}}"></div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
        
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal category resume -->
            <!-- modal category yesterday -->
            <div class="modal fade" id="modal_thursday" tabindex="-1" aria-labelledby="modal_add-menuLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="custom-modal-header">
                            <h5></h5>
                            <a class="close custom-modal-close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </a>
                        </div>
                        <div class="modal-body">
                            @foreach($categories_all as $category)
                                <h4>{{$category->name}}</h4>
                                <div id="result_body_thursday_{{$category->id}}"></div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
        
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal category resume -->
            <!-- modal category yesterday -->
            <div class="modal fade" id="modal_friday" tabindex="-1" aria-labelledby="modal_add-menuLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="custom-modal-header">
                            <h5></h5>
                            <a class="close custom-modal-close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </a>
                        </div>
                        <div class="modal-body">
                            @foreach($categories_all as $category)
                                <h4>{{$category->name}}</h4>
                                <div id="result_body_friday_{{$category->id}}"></div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
        
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
            if(data.length > 0){
                $.each(data[0], function(index, item){

                    $('#justifications').append(
                        "<div class='row'><div class='col-xl-12'><div class='accordion custom-card main-card-bg custom-card-padding-1' id='accordion_add-acompanhamento'><a class='custom-card-header' data-toggle='collapse' data-target='#collapse_add-"+item.id+"' aria-expanded='true' aria-controls='collapse_add-acompanhamento'><div class='custom-card-min-header' id='headingOne'><h6>"+item.user.email+"<span class='custom-collapse-arrow'></span></h6></div></a><div class='collapse_add-"+item.id+"' class='collapse' aria-labelledby='headingOne' data-parent='#accordion_add-acompanhamento'><div class='card-body'><p>"+item.description+"</p></div></div></div></div></div>" 
                    );

                });
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