<style>
    .switchToggled{display:none;}
</style>

@extends('layouts.app')


@section('content')
    <div class="container">
    <!--form method="POST" action="/data/submit"-->

    <form method="POST" action="/tasks/store" class="mrsif-form">
        {{ csrf_field() }}

        {{--@if(count($errors) >0)
            <div class="alert alert-danger">
                <ul>
                @foreach( $errors->all() as $error) 
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
        @endif--}}

        <input class="form-control" type="text" name="name" placeholder="Enter task name"><br/>
        <input class="form-control" type="text" name="description" placeholder="Enter task description"><br/>



        <div class="form-group datetimeWrapper">
            <input class="form-control" type="hidden" name="dateTime" id="dateTimeData">
            <div id="datetimepicker"></div>
        </div>

        {{--
        <!-- Switch -->
        <div class="switch">
            <label for="recurrSwitch">
            Off
            <input id="recurrSwitch" type="checkbox">
            <span class="lever"></span>
            On
            </label>
        </div>
        <div class="form-group switchToggled">
            <!--input class="form-control" type="number" pattern="[0-7]" name="recurring" placeholder="Recurring every X days"-->
            <div class="form-check">
                <label class="form-check-label" for="radio1">
                    <input type="radio" class="form-check-input" id="radio1" name="optradio" value="1" checked>Daily
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label" for="radio2">
                    <input type="radio" class="form-check-input" id="radio2" name="optradio" value="2">Weekly
                </label>
            </div>
        </div>
        --}}



        <br/>
        <input type="submit" name="submit" class="btn btn-primary mrsifSubmit">
    </form>
    </div>

@endsection


@section('scripts')
    <script src="https://kit.fontawesome.com/c2cc5ff5ba.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/moment@2.25.0/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.31/moment-timezone-with-data-1970-2030.js" integrity="sha512-nlCQXMhJDDqtrXXUXEsgnBuu7b+E4ph8onn2B4Utl1kayiXEhIHZqzRKNwfJJ7ZZG+hNUNWpew+NCKl9uSBz8g==" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/tempusdominus-bootstrap-4.min.js') }}" defer></script>


    <script type="text/javascript">
        $(function(){
            $('#datetimepicker').datetimepicker({
                inline: true,
                sideBySide: true,
                format: 'DD/MM/YYYY, HH:mm'
            });

            $('#dateTimeData').val(moment().utc().format('YYYY-MM-DD HH:mm'));

            $('#datetimepicker').on('change.datetimepicker', function (e) {
                //console.log(e.date.format('YYYY-MM-DD HH:mm:ss'));
                //$('#dateTimeData').val(e.date.format('YYYY-MM-DD HH:mm'));
                var mydate = e.date.format('YYYY-MM-DD HH:mm');
                var timezone = moment.tz.guess(true);
                console.log("date: "+mydate);
                console.log("timezone: "+timezone);
                console.log("utc: "+ moment.tz(mydate, timezone).utc().format('YYYY-MM-DD HH:mm') );
                $('#dateTimeData').val(moment.tz(mydate, timezone).utc().format('YYYY-MM-DD HH:mm'));

            });

            $('#recurrSwitch').change(function() {
                if($(this).is(":checked")) {
                    //console.log("Is checked");
                    $('.switchToggled').slideDown();
                    $('.switchToggled input').val('');
                }
                else {
                    //console.log("Is Not checked");
                    $('.switchToggled').slideUp(); 
                    $('.switchToggled input').val('');
                }
            })

        });
    </script>
@endsection