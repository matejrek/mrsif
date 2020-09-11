
@extends('layouts.app')


@section('content')
    <div class="container">
            <ul>
 
                <li>
                    {{$food->name}}<br/>
                    {{$food->description}}<br/>
                    Calories: {{$food->calories}}<br/>
                    Protein: {{$food->protein}}
                </li>

            </ul>
    </div>
@endsection

