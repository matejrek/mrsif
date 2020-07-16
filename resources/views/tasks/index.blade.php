@extends('layouts.app')


@section('content')
    <div class="heading">
        <h1>Tasks</h1>
    </div>
    <div class="container">
        <div id="ctime">
            <span class="ctime">Current time: 00:00:00</span>
        </div>
        <h2>Comming up tasks</h2>
        <div class="taskListContainer">
            <ul id="tasklist" class="itemList">
            @foreach( $tasks->all() as $item ) 
                <li><a href="/tasks/{{$item->id}}/complete">
                    Name:{{$item->name}} <br/>
                    Description: {{$item->description}} <br/>
                    Due: <span class="utcDueDate">{{$item->dateTime}}</span> <br/>
                     - Click to complete</a>
                </li>
            @endforeach
            </ul>
        </div>

        <h2>Overdue tasks</h2>
        <ul id="overdueTasklist" class="itemList">
        @foreach( $overdueTasks->all() as $item ) 
            <li><a href="/tasks/{{$item->id}}/complete">
                Name:{{$item->name}} <br/>
                Description: {{$item->description}} <br/>
                Due: <span class="utcDueDate">{{$item->dateTime}}</span> <br/>
                    - Click to complete</a>
            </li>
        @endforeach
        </ul>

        <br/>
        <a class="btn btn-primary" href="/tasks/create">Create task</a>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/moment@2.25.0/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.31/moment-timezone-with-data-1970-2030.js" integrity="sha512-nlCQXMhJDDqtrXXUXEsgnBuu7b+E4ph8onn2B4Utl1kayiXEhIHZqzRKNwfJJ7ZZG+hNUNWpew+NCKl9uSBz8g==" crossorigin="anonymous"></script>


    <script type="text/javascript">
        $(function(){
            var timezone = moment.tz.guess(true);

            //first time transform time, then just update...
            function adjustTimeStamps(){
                $('.utcDueDate').each(function(){
                    var taskDateTime = $(this).text();
                    //console.log("TS:" + taskDateTime);
                    //console.log(moment(taskDateTime).tz(timezone).format('Z'));
                    var timeDiff = moment(taskDateTime).tz(timezone).format('Z');
                    var newTime = moment(taskDateTime).add(timeDiff, 'hours').format('YYYY-MM-DD HH:mm:ss');
                    $(this).text(newTime);
                });
            }
            adjustTimeStamps();

            var timerId = setInterval(function() {
                //$('#ctime').load(document.URL +  ' .ctime');
                $('#ctime').text('Current time: '+moment().format("HH:mm:s")+'');
            }, 1000);
            var timerId2 = setInterval(function() {
                $('.taskListContainer').load(document.URL +  ' #tasklist', function(){
                    adjustTimeStamps();
                });
            }, 5000);
        });
    </script>
@endsection



