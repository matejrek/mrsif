@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul>
                        <li class="nav-item">
                            <a class="nav-link" href="/data">Add new routine</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/routines">View routines</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/feedback">Give feeback</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <h2>Routines</h2>
    <div class="row">
        @foreach ($routines as $item)
            <div class="col-md-4">
                <div class="title">{{ $item['name'] }}</div>
                <a href="routines/{{$item->id}}">Go</a>
            </div>
        @endforeach
    </div>

    <h2>Trackers:</h2>
    <div class="row">
        @php
            $trackersCount;   
        @endphp
        @foreach ($trackers as $item)
            <div class="col-md-4">
                <div class="title">{{ $item['name'] }}</div>
                <a href="/trackers/{{$item->id}}/result">Go</a>
            </div>
            @php
                $trackersCount = $loop->count
            @endphp
        @endforeach
        @if (number_format( ($trackersCount / 3) - floor($trackersCount / 3), 2 ) == 0.33)
            <div class="col-md-8">
                8 - {{$trackersCount}}
            </div>
        @endif
        @if (number_format( ($trackersCount / 3) - floor($trackersCount / 3), 2 ) == 0.67)
            <div class="col-md-4">
                4 - {{$trackersCount}}
            </div>
        @endif
        @if (number_format( ($trackersCount / 3) - floor($trackersCount / 3), 2 ) == 0.00)
            <div class="col-md-12">
                12 - {{$trackersCount}}
            </div>
        @endif

    </div>

</div>
@endsection
