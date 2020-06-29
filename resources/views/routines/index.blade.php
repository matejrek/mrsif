
@extends('layouts.app')


@section('content')
    <div class="heading">
        <h1>Routines</h1>
    </div>

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
                |
                <a href="routines/delete/{{$item->id}}">
                    Delete
                </a>
            </li>
        @endforeach

        </ul>

@endsection