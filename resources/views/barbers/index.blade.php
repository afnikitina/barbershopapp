@extends('layouts.app')

@section('title', 'Our Barbers')

@section('content')
    <h1>Meet Our Barbers</h1>

    <div>
        <a href="{{ route('barbers.show', ['id' => 2]) }}">Employee of the Month</a>
    </div>

    <ul>
        @forelse ($barbers as $barber)
            <li><a href="{{ action('BarbersController@show', [$barber->id]) }}">{{ $barber->name }}</a></li>
        @empty
            <li>No barbers are registered in our database.</li>
        @endforelse
    </ul>
@endsection

