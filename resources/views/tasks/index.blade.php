@extends('layouts.app')


@section('content')
    <div class="heading">
        <h1>Tasks</h1>
    </div>
    <div class="container">
        <div id="ctime">
            <span class="ctime">Current time: {{ \Carbon\Carbon::now() }}</span>
        </div>
        <div class="taskListContainer">
            <ul id="tasklist" class="itemList">
            @foreach( $tasks->all() as $item ) 
                <li><a href="/tasks/{{$item->id}}/complete">
                    Name:{{$item->name}} <br/>
                    Description: {{$item->description}} <br/>
                    Due: {{$item->dateTime}} <br/>
                     - Click to complete</a>
                </li>
            @endforeach
            </ul>
        </div>
        <br/>
        <a class="btn btn-primary" href="/tasks/create">Create task</a>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function(){
            var timerId = setInterval(function() {
                $('#ctime').load(document.URL +  ' .ctime');
            }, 1000);
            var timerId2 = setInterval(function() {
                $('.taskListContainer').load(document.URL +  ' #tasklist');
            }, 5000);
        });
    </script>
@endsection



