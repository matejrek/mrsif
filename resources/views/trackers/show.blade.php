@extends('layouts.app')


@section('content')
    <div class="container">
        <ul>
        @foreach( $results as $item )
            <li>
                {{$item->value}}<span>{{$tracker2}}</span>
            </li>
        @endforeach
        </ul>
        <form method="POST" action="/trackers/{{$tracker->tracker_id}}/result/store" class="mrsif-form">
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


            <input class="form-control" type="number" name="value" placeholder="Enter value of result"><br/>


            <input type="submit" name="submit" class="btn btn-primary mrsifSubmit">
        </form>

    </div>
@endsection



