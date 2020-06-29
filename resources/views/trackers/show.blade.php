<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="chartWrapper">
            <!--div id="chart" style="width:100%; height:400px; background:rgba(0,0,0,0.2);"></div-->
             <canvas id="chartJSContainer" style="width:100%; height:400px; background:rgba(255,255,255,1);"></canvas>
        </div>

        @if($init == 1)
            <form method="POST" action="/trackers/{{$tracker->tracker_id}}/result/store" class="mrsif-form">
                {{ csrf_field() }}

                @if(count($errors) >0)
                    <div class="alert alert-danger">
                        <ul>
                        @foreach( $errors->all() as $error) 
                            <li>{{$error}}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif

                <input class="form-control" type="number"  step="0.1"  min="0" max="2000" name="value" placeholder="Enter value of result"><br/>

                <input type="submit" name="submit" class="btn btn-primary mrsifSubmit">
            </form>
        @else
            @if($canAddNew != 0)

                <form method="POST" action="/trackers/{{$tracker->tracker_id}}/result/store" class="mrsif-form">
                    {{ csrf_field() }}

                    @if(count($errors) >0)
                        <div class="alert alert-danger">
                            <ul>
                            @foreach( $errors->all() as $error) 
                                <li>{{$error}}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif

                    <input class="form-control" type="number"  step="0.1" min="0" max="2000" name="value" placeholder="Enter value of result"><br/>

                    <input type="submit" name="submit" class="btn btn-primary mrsifSubmit">
                </form>

            @else
                <br/>
                <p><strong>You already added a entry in last interval. {{$diff}}h ago. {{--Next Entry tomorrow or retake.--}} Entry interval is {{$interval}}h.</strong></p><br/>
    
                <form action="/trackers/result/{{$lastResultId}}/retake" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <input class="form-control" type="number" step="0.1" min="0" max="2000" name="value" placeholder="Re-Enter value of last result"><br/>

                    <input type="submit" name="submit" class="btn btn-primary">

                </form>
            @endif
        @endif
        <br/>
        <hr/>
        <button type="button" class="btn btn-primary" id="getWeekly">Show last week</button> 
        <button type="button" class="btn btn-primary" id="getMonthly">Show last month</button>
        <button type="button" class="btn btn-primary" id="getAll">Show all</button>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/moment@2.25.0/moment.js"></script>
    <script type="text/javascript">
        $(function(){
            var isInit = @json($init);
            if( isInit == 0){
                var chartLabel = @json($chartLabel ?? '');
                var chartData = @json($chartData ?? '');
                var unit = @json($unit ?? '');
                var title = @json($chartTitle ?? '');
                //console.log(chartLabel);
                //console.log(chartData);
                var options = {
                    type: 'line',
                    data: {
                        labels: chartLabel,
                        datasets: [
                            {
                                label: 'Unit:' + unit,
                                data: chartData,
                                borderWidth: 4
                            }
                            ]
                        },
                        options:{
                        scales:{
                            yAxes:[{
                                ticks:{
                                    reverse:false
                                }
                            }]
                        }
                    }
                }
                var ctx = document.getElementById('chartJSContainer').getContext('2d');
                new Chart(ctx, options);
            }

            function updateChart(data){
                var chartData = Object.values(data).map(e => e.value);
                var chartLabel = Object.values(data).map(e => moment(e.created_at).format('YYYY-MM-DD'));
                //console.log(chartData);
                //console.log(Math.max.apply(null, chartData));
                var $chart = $('#chartJSContainer');
                var lineChartHome = new Chart($chart[0].getContext("2d"), {

                    type: 'line',
                    data: {
                        labels: chartLabel,
                        datasets: [
                            {
                                label: 'Unit:' + unit,
                                data: chartData,
                                borderWidth: 4
                            }
                            ]
                        },
                        options:{
                        scales:{
                            yAxes:[{
                                ticks:{
                                    reverse:false,
                                    max: (Math.max.apply(null, chartData) + 20),
                                    min: (Math.min.apply(null, chartData) - 20)
                                }
                            }]
                        }
                    }
                })
            }


            $('#getWeekly').on('click', function(){
                getWeekly();
            });
            function getWeekly(){
                var trackerId = @json($id);
                $.ajax({
                    type: 'GET',
                    url: '/trackers/weekly/'+trackerId+'',
                    success: function (data){
                        //console.log(data);

                        /*const value = Object.values(data).map(e => e.value)
                        console.log(value)

                        const label = Object.values(data).map(e => e.created_at)
                        console.log(label)*/

                        //rebuild graph
                        updateChart(data);
                    },
                    error: function(){
                        console.log(data);
                    }
                });
            }

            $('#getMonthly').on('click', function(){
                getMonthly();
            });
            function getMonthly(){
                var trackerId = @json($id);
                $.ajax({
                    type: 'GET',
                    url: '/trackers/monthly/'+trackerId+'',
                    success: function (data){
                        //console.log(data);
                        updateChart(data);
                    },
                    error: function(){
                        console.log(data);
                    }
                });
            }

            $('#getAll').on('click', function(){
                getAll();
            });
            function getAll(){
                var trackerId = @json($id);
                $.ajax({
                    type: 'GET',
                    url: '/trackers/all/'+trackerId+'',
                    success: function (data){
                        //console.log(data);
                        updateChart(data);
                    },
                    error: function(){
                        console.log(data);
                    }
                });
            }
        });
    </script>

@endsection