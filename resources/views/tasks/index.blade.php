@extends('layouts.app')


@section('content')
    <div class="container">
        <ul>
        @foreach( $tasks->all() as $item ) 
            <li>
                Name:{{$item->name}} <br/>
                Description: {{$item->description}} <br/>
                Due: {{$item->dateTime}}
            </li>
        @endforeach
        </ul>
        <br/>
        <a class="btn btn-primary" href="/tasks/create">Create task</a>
    </div>
@endsection




