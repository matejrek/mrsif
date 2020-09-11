@extends('layouts.app')


@section('content')
    <div class="container">
    <!--form method="POST" action="/data/submit"-->

    <form method="POST" action="/food/store" class="mrsif-form">
        {{ csrf_field() }}

        @if(count($errors) >0)
            <div class="alert alert-danger">
                <ul>
                @foreach( $errors->all() as $error) 
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
        @endif

        <input class="form-control" type="text" name="name" placeholder="Enter food name"><br/>
        <input class="form-control" type="text" name="description" placeholder="Enter food description"><br/>
        <input class="form-control" type="number" name="calories" placeholder="Enter amount of calories"><br/>
        <input class="form-control" type="number" name="protein" placeholder="Enter amount of protein in grams"><br/>

        <input type="submit" name="submit" class="btn btn-primary mrsifSubmit">
    </form>
    </div>


@endsection