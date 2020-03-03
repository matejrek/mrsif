@extends('layouts.app')


@section('content')
    <div class="container">
        <!--form method="POST" action="/data/submit"-->
        <form method="POST" action="/feedback/submit">
            {{ csrf_field() }}
            <input class="form-control" type="text" name="subject" placeholder="Subject"> <br/>

            <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Enter a message"></textarea> <br/>
            
            <input type="submit" name="submit" class="btn btn-primary">
        </form>
    </div>

@endsection




