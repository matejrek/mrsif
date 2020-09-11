@extends('layouts.app')


@section('content')
    <div class="container">

        <form action="/food/{{$food->id}}/edit/save" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">

            @if(count($errors) >0)
                <div class="alert alert-danger">
                    <ul>
                    @foreach( $errors->all() as $error) 
                        <li>{{$error}}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            <input class="form-control" type="text" name="name" placeholder="Enter food name" value="{{$food['name']}}"><br/>
            <input class="form-control" type="text" name="description" placeholder="Enter food description" value="{{$food['description']}}"><br/>
            <input class="form-control" type="number" name="calories" placeholder="Enter amount of calories" value="{{$food['calories']}}"><br/>
            <input class="form-control" type="number" name="protein" placeholder="Enter amount of protein in grams" value="{{$food['protein']}}"><br/>


            <br/><br/>
            <input type="submit" name="submit" class="btn btn-primary">

        </form>
    </div>
@endsection
