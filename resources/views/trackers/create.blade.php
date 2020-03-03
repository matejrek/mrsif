@extends('layouts.app')


@section('content')
    <div class="container">
    <!--form method="POST" action="/data/submit"-->

    <form method="POST" action="/trackers/store" class="mrsif-form">
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

        <input class="form-control" type="text" name="name" placeholder="Enter tracker name"><br/>
        <input class="form-control" type="text" name="unit_type" placeholder="Enter measuring unit (kg, lbs,...)"><br/>
        <input class="form-control" type="number" name="interval" placeholder="Enter tracking interval (1,2,3 per day)"><br/>


        <input type="submit" name="submit" class="btn btn-primary mrsifSubmit">
    </form>
    </div>


@endsection