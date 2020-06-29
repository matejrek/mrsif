@extends('layouts.app')


@section('content')
    <div class="heading">
        <h1>Trackers</h1>
    </div>

    <div class="container">
        <ul class="itemList">
        @foreach( $results->all() as $item ) 
            <li><a href="/trackers/{{$item->id}}/result">{{$item->name}}</a></li>
        @endforeach
        </ul>

        <a class="btn btn-primary" href="/trackers/create">Create new tracker</a>
    </div>
@endsection




