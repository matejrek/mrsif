@extends('layouts.app')


@section('content')
        <ul>
        @foreach($results as $item)
            <li>
                {{$item}}
            </li>
        @endforeach
        </ul>

        <a href="/store">Create new tracker</a>
@endsection




