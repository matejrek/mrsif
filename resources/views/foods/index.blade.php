@extends('layouts.app')


@section('content')
    <div class="heading">
        <h1>Foods</h1>
    </div>

    <div class="container">
        <ul>
        @foreach($foods as $item)
            <li>
                <a href="food/{{$item->id}}">
                    {{ $item['name'] }}
                </a>
                |
                <a href="food/{{$item->id}}/edit">
                    Edit
                </a>
                |
                <a href="food/delete/{{$item->id}}">
                    Delete
                </a>
            </li>
        @endforeach
        </ul>

        <a class="btn btn-primary" href="/food/create">Create new food</a>
    </div>
@endsection




