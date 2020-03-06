<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="chartWrapper">
            <!--div id="chart" style="width:100%; height:400px; background:rgba(0,0,0,0.2);"></div-->
             <canvas id="chartJSContainer" width="600" height="400"></canvas>
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

                <input class="form-control" type="number"  step="0.5"  min="1" max="200" name="value" placeholder="Enter value of result"><br/>

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

                    <input class="form-control" type="number"  step="0.5" min="1" max="200" name="value" placeholder="Enter value of result"><br/>

                    <input type="submit" name="submit" class="btn btn-primary mrsifSubmit">
                </form>

            @else
                <br/>
                <p><strong>You already added a entry today. {{$diff}}h ago. Next Entry tomorrow or retake.</strong></p><br/>
    
                <form action="/trackers/result/{{$lastResultId}}/retake" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <input class="form-control" type="number" step="0.5" min="1" max="200" name="value" placeholder="Re-Enter value of last result"><br/>

                    <input type="submit" name="submit" class="btn btn-primary">

                </form>
            @endif
        @endif

        <script type="text/javascript">
            $(document).ready(function(){
                var isInit = @json($init);
                if( isInit == 0){
                    var chartLabel = @json($chartLabel ?? '');
                    var chartData = @json($chartData ?? '');
                    var unit = @json($unit ?? '');
                    var title = @json($chartTitle ?? '');

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
            });
        </script>
    </div>
@endsection
