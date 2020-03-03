@extends('layouts.app')


@section('content')
    <div class="container">
        <ul>
        @foreach($results as $item)
            <li>
                {{$item->name}}
            </li>
        @endforeach

        </ul>

        <form method="POST" action="/trackers/type/store" class="mrsif-form">
            {{ csrf_field() }}

            <input class="form-control" type="text" name="name" placeholder="Enter new tracker name"><br/>

            <input type="submit" name="submit" class="btn btn-primary mrsifSubmit">
        </form>
    </div>


@endsection