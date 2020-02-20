@extends('layouts.app')


@section('content')
        <ul>
        @foreach($routines as $item)
            <li>
                <a href="routines/{{$item->id}}">
                    {{ $item['name'] }}
                </a>
                |
                <a href="routines/{{$item->id}}/edit">
                    Edit
                </a>
            </li>
        @endforeach

        </ul>

@endsection




