@extends('layouts.app')


@section('content')
    <div class="container">
        <div id="ctime">
        Current time: {{ \Carbon\Carbon::now() }}
        </div>
        <ul id="tasklist">
        @foreach( $tasks->all() as $item ) 
            <li>
                Name:{{$item->name}} <br/>
                Description: {{$item->description}} <br/>
                Due: {{$item->dateTime}} <br/>
                <a href="/tasks/{{$item->id}}/complete">Complete</a>
            </li>
        @endforeach
        </ul>
        <br/>
        <a class="btn btn-primary" href="/tasks/create">Create task</a>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function(){
            var timerId = setInterval(function() {
                $('#ctime').load(document.URL +  ' #ctime');
            }, 1000);
            var timerId2 = setInterval(function() {
                $('#tasklist').load(document.URL +  ' #tasklist');
            }, 5000);
        });
    </script>
@endsection


