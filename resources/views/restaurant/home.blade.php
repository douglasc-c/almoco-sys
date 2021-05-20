@extends('restaurant.layouts.default')

@section('title')


@parent
@stop

@section('content')
<form method="POST" action="{{URL::action('Restaurant\MenuController@createMenu')}}">
    {{ csrf_field() }}
<div class="row">
        
        <div class="col-xl-3">
            <div class="custom-card dark-card-bg main-card-padding">
                <div class="row">
                    <div class="col-xl-12 custom-card-header-bloc">
                        <h6>Selecione o dia que deseja incluir o menu</h6>
                    </div>
                </div>
            </div>
            <div class="accordion custom-card main-card-bg main-card-padding" id="accordionExample" >
                <div class="col-xl-12 custom-card-header-bloc">
                    <h6>Selecione o dia que deseja editar</h6>
                </div>
                @php 
                $today = today();

                echo '<h1 class="w3-text-teal"><center><span id="text_month">' . $today->format('F Y') . '</span></center></h1>';

                $tempDate = Carbon\Carbon::createFromDate($today->year, $today->month, 1);



                echo '<table border="1" class = "w3-table w3-boarder w3-striped main-calendar">
                    <thead><tr class="w3-theme">
                    <th>Sun</th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
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
                        // echo '<td><button type="button" class="date calendar-bubble-day" onclick="teste(';
                        // echo $tempDate->day, $tempDate->month;   
                        // echo ')">';
                        echo '<td><button type="button" class="date calendar-bubble-day" onclick="select_day(';
                        echo $tempDate->day;
                        echo ','; 
                        echo $tempDate->month;   
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
                            <h6>Adicionar menu</h6>
                        </a>
                    </div>
                </div>
            </div>
    <!-- bloco de menu, pode ser adicionado através do modal -->
            @foreach($categoriesAll as $category)
            <div class="row">
                <div class="col-xl-12">
                    <div class="accordion custom-card main-card-bg custom-card-padding-1" id="accordion_add-acompanhamento">
                        <a class="custom-card-header" data-toggle="collapse" data-target="#collapse_add-{{$category['name']}}" aria-expanded="true" aria-controls="collapse_add-acompanhamento">
                            <div class="custom-card-min-header" id="headingOne">
                            
                                <h6>
                                    {{$category['name']}}
                                    <span class="custom-collapse-arrow"></span>
                                </h6>
                            </div>
                        </a>
                        <div id="collapse_add-{{$category['name']}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_add-acompanhamento">
                            <div class="card-body">
                                <ul class="menu-ul">
                                    <!-- list item -->
                                    @foreach($category['itens'] as $item)
                                        <li>
                                            <div class="row menu-list-row">
                                                <div class="col-xl-2 zeroed-col menu-list-checkbox-bloc">
                                                    <div class="rounded-checkbox">
                                                        <input type="checkbox" id="{{$item->name}}" name="checkbox[{{$item->name}}]"/>
                                                        <label for="{{$item->name}}"></label>
                                                    </div>
                                                </div>
                                                <div class="col-xl-8 zeroed-col">
                                                    <label for="{{$item->name}}" class="menu-list-title">{{$item->name}}</label>
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
                                    @endforeach
                                </ul>
                            </div>
                            <button type="button" class="btn btn-light m-1 px-5 card-border-theme2 btn-theme2" data-toggle="modal" data-target="#newFood{{$category['name']}}">Novo Alimento</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--   -->
            <div class="modal fade" id="newFood{{$category['name']}}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content radius-30">
                    <div class="modal-header border-bottom-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-5">
                        <form method="POST" id="createProduct{{$category['name']}}" action="{{URL::action('Restaurant\FoodController@createFood')}}">
                            {{ csrf_field() }}
                        <h3 class="text-center">Cadastrar Novo Alimento</h3>
                        <div class="form-group">
                            <label>Nome do alimento</label>
                            <input type="text" name="name" id="name_{{$category['name']}}" class="form-control form-control-lg radius-30" placeholder="Digite o nome do alimento"/>
                        </div>
                        <div class="form-group">
                            <label>Descrição</label>
                            <input type="text" name="description" class="form-control form-control-lg radius-30" placeholder=""/>
                        </div>
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
            <input type="hidden" id="month_value" name="month_value">
            <input type="hidden" id="day_value" name="day_value">
            <div class="row">
                    <button type="submit">Enviar</button>
            </div>
        </form>
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
                            <p>{{Carbon\Carbon::today()->addDays(2)->format('d/m/Y')}}</p>
                        </div>
                        <div class="col-xl-12">
                            <div>
                                <h6><i class="fa fa-circle active"></i> {{$orders['day+2']}} Confirmados</h6>
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
                            <p>{{Carbon\Carbon::today()->addDays(1)->format('d/m/Y')}}</p>
                        </div>
                        <div class="col-xl-12">
                            <div>
                                <h6><i class="fa fa-circle active"></i> {{$orders['day+1']}} Confirmados</h6>
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
                            <p>{{Carbon\Carbon::today()->format('d/m/Y')}}</p>
                        </div>
                        <div class="col-xl-12">
                            <div>
                                <h6><i class="fa fa-circle pending"></i> {{$orders['today']}} Confirmados</h6>
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
                            <p>{{Carbon\Carbon::today()->subDays(1)->format('d/m/Y')}}</p>
                        </div>
                        <div class="col-xl-12">
                            <div>
                                <h6><i class="fa fa-circle inative"></i> {{$orders['day-1']}} Confirmados</h6>
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
                            <p>{{Carbon\Carbon::today()->subDays(2)->format('d/m/Y')}}</p>
                        </div>
                        <div class="col-xl-12">
                            <div>
                                <h6><i class="fa fa-circle inative"></i> {{$orders['day-2']}} Confirmados</h6>
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
                    <a class="custom-card-header" data-toggle="collapse" data-target="#collapse_menu-next-two_day" aria-expanded="true" aria-controls="collapse_menu-next-two_day">
                        <div class="custom-card-min-header" id="headingOne">
                            <h6>
                                <i class="fa fa-circle active"></i> {{Carbon\Carbon::today()->addDays(2)->format('d/m/Y')}}
                                <span class="custom-collapse-arrow"></span>
                            </h6>
                        </div>
                    </a>
                    <div id="collapse_menu-next-two_day" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_menu-dia-0402">
                        
                        <div class="card-body">
                            <ul class="">
                                @foreach($all_category_next_two_day as $category)
                                <li>
                                    <p>{{$category['amount']}} - {{$category['name']}}</p>
                                </li>
                                @endforeach
                            </ul>
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modal_next_two_day">Detalhes</a>
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
                                <i class="fa fa-circle active"></i> {{Carbon\Carbon::today()->addDays(1)->format('d/m/Y')}}
                                <span class="custom-collapse-arrow"></span>
                            </h6>
                        </div>
                    </a>
                    <div id="collapse_menu-dia-0402" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_menu-dia-0402">
                        <div class="card-body">
                                <ul class="">
                                    @foreach($all_category_next_day as $category)
                                    <li>
                                        <p>{{$category['amount']}} - {{$category['name']}}</p>
                                    </li>
                                    @endforeach
                                </ul>
                                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modal_next_day">Detalhes</a>
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
                                {{Carbon\Carbon::today()->format('d/m/Y')}}
                                <span class="custom-collapse-arrow"></span>
                            </h6>
                        </div>
                    </a>
                    <div id="collapse_menu-dia-0502" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_menu-dia-0502">
                        <div class="card-body">
                                <ul class="">
                                    @foreach($all_category as $category)
                                    <li>
                                        <p>{{$category['amount']}} - {{$category['name']}}</p>
                                    </li>
                                    @endforeach
                                </ul>
                                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modal_today">Detalhes</a>
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
                                <i class="fa fa-circle active"></i> {{Carbon\Carbon::today()->subDays(1)->format('d/m/Y')}}
                                <span class="custom-collapse-arrow"></span>
                            </h6>
                        </div>
                    </a>
                    <div id="collapse_menu-yesterday" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_menu-dia-0402">
                        <div class="card-body">
                            <ul class="">
                                @foreach($all_category_yesterday as $category)
                                <li>
                                    <p>{{$category['amount']}} - {{$category['name']}}</p>
                                </li>
                                @endforeach
                            </ul>
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modal_yesterday">Detalhes</a>
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
                                <i class="fa fa-circle active"></i> {{Carbon\Carbon::today()->subDays(2)->format('d/m/Y')}}
                                <span class="custom-collapse-arrow"></span>
                            </h6>
                        </div>
                    </a>
                    <div id="collapse_menu-before-yesterday" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_menu-dia-0402">
                        <div class="card-body">
                            <ul class="">
                                @foreach($all_category_before_yesterday as $category)
                                <li>
                                    <p>{{$category['amount']}} - {{$category['name']}}</p>
                                </li>
                                @endforeach
                            </ul>
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modal_before_yesterday">Detalhes</a>
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
        <div class="modal fade" id="modal_next_two_day" tabindex="-1" aria-labelledby="modal_add-menuLabel" aria-hidden="true">
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
                                <div id="result_body_after_tomorrow_{{$category->id}}"></div>
                            @endforeach
                            {{-- <div id="result_body_after_tomorrow"></div> --}}
                        </div>
                        <div class="modal-footer">
        
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal category resume -->
            <!-- modal category tomorrow -->
            <div class="modal fade" id="modal_next_day" tabindex="-1" aria-labelledby="modal_add-menuLabel" aria-hidden="true">
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
                                <div id="result_body_tomorrow_{{$category->id}}"></div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
        
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal category resume -->
            <!-- modal category today -->
            <div class="modal fade" id="modal_today" tabindex="-1" aria-labelledby="modal_add-menuLabel" aria-hidden="true">
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
                                <div id="result_body_today_{{$category->id}}"></div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
        
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal category resume -->
            <!-- modal category yesterday -->
            <div class="modal fade" id="modal_yesterday" tabindex="-1" aria-labelledby="modal_add-menuLabel" aria-hidden="true">
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
                                <div id="result_body_yesterday_{{$category->id}}"></div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
        
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal category resume -->
            <!-- modal category yesterday -->
            <div class="modal fade" id="modal_before_yesterday" tabindex="-1" aria-labelledby="modal_add-menuLabel" aria-hidden="true">
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
                                <div id="result_body_before_yesterday_{{$category->id}}"></div>
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
            $("#date-"+item).css("background-color", "green");
        });
    });
</script>
<script>
    function newProduct(category){
        var cat = category;
        var name = $('#name_'+category).val();
        var _token = $('#_token').val();

        $.ajax({
		    type: "POST",
		    url: "{{URL::action('Restaurant\FoodController@createFood')}}",
		    data: {
                _token: _token,
                name: name,
                category: cat,
            },
		    success: function (result) {
                location.reload();
		    }
		});
    }

</script>
<script>
function select_day(day, month){
    $('#day_value').val(day);
    $('#month_value').val(month);
    if(month == 6){
        $('#text_month').text('Junho 2021');
    }else if(month == 5){
        $('#text_month').text('Maio 2021');
    }
}

</script>
<script>
$(document).ready(function(){

    var after_tomorrow = 'after_tomorrow';
    var tomorrow = 'tomorrow';
    var today = 'today';
    var yesterday = 'yesterday';
    var before_yesterday = 'before_yesterday';

    $('#modal_next_two_day').on('show.bs.modal', function () {

        $.ajax({
		    type: "GET",
		    url: "{{URL::action('Restaurant\MenuController@dataDetailMenu')}}",
		    data: {
                day: after_tomorrow,
            },
		    success: function (data) {
                if(data.length > 0){
                    $('#result_body_after_tomorrow').empty();
                    $.each(data[0], function(index, item){
                        if(item.amount > 0){
                            $('#result_body_after_tomorrow_'+item.category_id).append("<p>"+item.amount+" - "+item.name+"</p>");
                        }
                    });
                }
		    }
		});

    });

    $('#modal_next_day').on('show.bs.modal', function () {

        $.ajax({
		    type: "GET",
		    url: "{{URL::action('Restaurant\MenuController@dataDetailMenu')}}",
		    data: {
                day: tomorrow,
            },
		    success: function (data) {
                
                if(data.length > 0){
                    $('#result_body_tomorrow').empty();
                    $.each(data[0], function(index, item){
                        if(item.amount > 0){
                            $('#result_body_tomorrow_'+item.category_id).append("<p>"+item.amount+" - "+item.name+"</p>");
                        }
                    });
                }

		    }
		});

    });
    
    $('#modal_today').on('show.bs.modal', function () {

        $.ajax({
		    type: "GET",
		    url: "{{URL::action('Restaurant\MenuController@dataDetailMenu')}}",
		    data: {
                day: today,
            },
		    success: function (data) {
                if(data.length > 0){
                    $('#result_body_today').empty();
                    $.each(data[0], function(index, item){
                        if(item.amount > 0){
                            $('#result_body_today_'+item.category_id).append("<p>"+item.amount+" - "+item.name+"</p>");
                        }
                        
                    });
                }
		    }
		});

    });

    $('#modal_yesterday').on('show.bs.modal', function () {

        $.ajax({
            type: "GET",
            url: "{{URL::action('Restaurant\MenuController@dataDetailMenu')}}",
            data: {
                day: yesterday,
            },
            success: function (data) {
                if(data.length > 0){
                    $('#result_body_yesterday').empty();
                    $.each(data[0], function(index, item){
                        if(item.amount > 0){
                            $('#result_body_yesterday_'+item.category_id).append("<p>"+item.amount+" - "+item.name+"</p>");
                        }
                    });
                }
            }
        });

    });
    $('#modal_before_yesterday').on('show.bs.modal', function () {

        $.ajax({
            type: "GET",
            url: "{{URL::action('Restaurant\MenuController@dataDetailMenu')}}",
            data: {
                day: before_yesterday,
            },
            success: function (data) {
                if(data.length > 0){
                    $('#result_body_before_yesterday').empty();
                    $.each(data[0], function(index, item){
                        if(item.amount > 0){
                            $('#result_body_before_yesterday_'+item.category_id).append("<p>"+item.amount+" - "+item.name+"</p>");
                        }
                    });
                }
            }
        });
    });
    
});
</script>
@stop