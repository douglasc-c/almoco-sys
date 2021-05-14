@extends('restaurant.layouts.default')

@section('title')


@parent
@stop

@section('content')
<form method="POST" action="{{URL::action('Restaurant\MenuController@createMenu')}}">
    {{ csrf_field() }}
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
                                <select class="datefield month" name="month">
                                    <option value="">Month</option>
                                    <option value="01">Jan</option>
                                    <option value="02">Feb</option>
                                    <option value="03">Mar</option>
                                    <option value="04">Apr</option>
                                    <option value="05">May</option>
                                    <option value="06">Jun</option>
                                    <option value="07">Jul</option>
                                    <option value="08">Aug</option>
                                    <option value="09">Sep</option>
                                    <option value="10">Oct</option>
                                    <option value="11">Nov</option>
                                    <option value="12">Dec</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion custom-card main-card-bg main-card-padding" id="accordionExample" >
                <div class="col-xl-12 custom-card-header-bloc">
                    <h6>Selecione o dia que deseja editar</h6>
                </div>
                {{-- <div class="col-xl-12" style="margin-top: 3%;">
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
                                    <input type="radio" id="day1" name="day" value="1">
                                    <label for="day1">1</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day2" name="day" value="2">
                                    <label for="day1">2</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day3" name="day" value="3">
                                    <label for="day1">3</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day4" name="day" value="4">
                                    <label for="day1">4</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day5" name="day" value="5">
                                    <label for="day1">5</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day6" name="day" value="6">
                                    <label for="day1">6</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day7" name="day" value="7">
                                    <label for="day1">7</label><br>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day8" name="day" value="8">
                                    <label for="day1">8</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day9" name="day" value="9">
                                    <label for="day1">9</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day10" name="day" value="10">
                                    <label for="day1">10</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day11" name="day" value="11">
                                    <label for="day1">11</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day12" name="day" value="12">
                                    <label for="day1">12</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day13" name="day" value="13">
                                    <label for="day1">13</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day14" name="day" value="14">
                                    <label for="day1">14</label><br>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day15" name="day" value="15">
                                    <label for="day1">15</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day16" name="day" value="16">
                                    <label for="day1">16</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day17" name="day" value="17">
                                    <label for="day1">17</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day18" name="day" value="18">
                                    <label for="day1">18</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day19" name="day" value="19">
                                    <label for="day1">19</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day20" name="day" value="20">
                                    <label for="day1">20</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day21" name="day" value="21">
                                    <label for="day1">21</label><br>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day22" name="day" value="22">
                                    <label for="day1">22</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day23" name="day" value="23">
                                    <label for="day1">23</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day24" name="day" value="24">
                                    <label for="day1">24</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day25" name="day" value="25">
                                    <label for="day1">25</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day26" name="day" value="26">
                                    <label for="day1">26</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day27" name="day" value="27">
                                    <label for="day1">27</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day28" name="day" value="28">
                                    <label for="day1">28</label><br>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day29" name="day" value="29">
                                    <label for="day1">29</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day30" name="day" value="30">
                                    <label for="day1">30</label><br>
                                </div>
                            </td>
                            <td>
                                <div class="calendar-bubble-day">
                                    <input type="radio" id="day31" name="day" value="31">
                                    <label for="day1">31</label><br>
                                </div>
                            </td>
                    </table>
                </div> --}}
                @php 
                $today = today();

                echo '<h1 class="w3-text-teal"><center><span id="text_month">' . $today->format('F Y') . '</span></center></h1>';

                $tempDate = Carbon\Carbon::createFromDate($today->year, $today->month, 1);



                echo '<table border="1" class = "w3-table w3-boarder w3-striped">
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
                        // echo '<td><button type="button" class="date" onclick="teste(';
                        // echo $tempDate->day, $tempDate->month;   
                        // echo ')">';
                        echo '<td><button type="button" class="date" onclick="teste(';
                        echo $tempDate->day;
                        echo ','; 
                        echo $tempDate->month;   
                        echo ')">';

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
    <input type="hidden" id="_token" value=" {{ csrf_token() }} ">
@endsection
@section('scripts')
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
function teste(day, month){
    $('#day_value').val(day);
    $('#month_value').val(month);
    // alert(month);
    if(month == 6){
        // alert('foi');
        $('#text_month').text('Junho 2021');
    }else if(month == 5){
        $('#text_month').text('Maio 2021');
    }
}

</script>
@stop