@extends('layouts.app')


@section('content')
    <div class="container">
        <ul>
        @foreach( $results->all() as $item ) 
            <li>{{$item->name}} | <a href="/trackers/{{$item->id}}/result">View results and add new data</a></li>
        @endforeach
        </ul>

        <a class="btn btn-primary" href="/trackers/create">Create new tracker</a>
    </div>
@endsection




