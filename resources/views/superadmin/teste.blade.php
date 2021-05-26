@extends('superAdmin.layouts.default')


@section('title')
Home -
@parent
@stop

@section('content')

<div class="row">
      
        <div class="panel panel-white">

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
                    <button type="submit" id="get_filter" class="btn btn-block btn-success" style="margin-top: 34px">Filtrar</button>
                </div>
                </div>
        </div>
        

   
</div>

<div class="row">
        <canvas id="graphicWeek" height="230vh" width="400vw" style="max-width: 800px;"></canvas>
</div>

<div class="row">
        <canvas id="mycanvas" style="max-width: 800px;"></canvas>
</div>

@endsection

@section('styles')
<style type="text/css">

</style>
@stop


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script>
	$("#get_filter").on('click', function(){

		var from_date = $("#from_date").val();
		var to_date = $("#to_date").val();
        // console.log('testeeeer');
        // graph
                    // used for example purposes
            // function getRandomIntInclusive(min, max) {
            // min = Math.ceil(min);
            // max = Math.floor(max);
            // return Math.floor(Math.random() * (max - min + 1)) + min;
            // }

            // create initial empty chart
            var ctx_live = document.getElementById("mycanvas");
            var myChart = new Chart(ctx_live, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                data: [],
                borderWidth: 1,
                borderColor:'#00c0ef',
                label: 'liveCount',
                }]
            },
            options: {
                responsive: true,
                title: {
                display: true,
                text: "Chart.js - Dynamically Update Chart Via Ajax Requests",
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
            url: "{{URL::action('SuperAdmin\HomeController@getReportData')}}",
            data: {
                from_date: from_date,
                to_date: to_date,
            },
            success: function (data) {
                console.log(data);
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

@stop