@extends('layouts.app')


@section('content')
    <div class="container">
        <!--div id="ctime">
            <span class="ctime">Current Date/time: {{ \Carbon\Carbon::now() }}</span>
        </div-->
        <div id="stopwatch">
            <div class="timer">
                00:00:00
            </div>
            <div class="options">
                <button type="button" class="btn btn-primary" id="startStopwatch">Start</button> 
                <button type="button" class="btn btn-primary" id="pauseStopwatch">Pause</button> 
                <button type="button" class="btn btn-primary" id="resetStopwatch">Reset</button> 
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://kit.fontawesome.com/c2cc5ff5ba.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/moment@2.25.0/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-duration-format/1.3.0/moment-duration-format.min.js"></script>

    <script type="text/javascript">
        $(function(){
            /*var timerId = setInterval(function() {
                $('#ctime').load(document.URL +  ' .ctime');
            }, 1000);*/
            var running = 0;
            var seconds = 0;

            var timerId = setInterval(function() {
                if(running != 0){
                    seconds++;
                    var formatted = moment.duration(seconds, "seconds").format("HH:mm:ss", {
                        stopTrim: "h"
                    });
                    $('#stopwatch .timer').text(formatted);
                }
            }, 1000);

            $('#startStopwatch').on('click', function(){
                running++;
            });
            $('#pauseStopwatch').on('click', function(){
                running=0;
            });
            $('#resetStopwatch').on('click', function(){
                running=0;
                seconds=0;
                $('#stopwatch .timer').text('00:00:00');
            });
        });
    </script>

@endsection