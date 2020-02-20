@extends('layouts.app')


@section('content')

        <ul>
            <li>
                {{ $routine['name'] }}
                |
                <a href="/{{$routine['id']}}/edit">
                    Edit
                </a>
                <ul>
                    @foreach( $routine['sections'] as $item )
                        <li>
                            <strong>Section:</strong> {{$item['name']}}
                            <ul>
                            @foreach( $item['exercises'] as $item2 )
                                <li>
                                    <strong>Exercise:</strong> {{$item2['name']}}
                                </li>
                            @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </li>
        </ul>

@endsection



