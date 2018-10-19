@extends('layouts.app')

@section('title', 'Our Barbers')

@section('content')
    <div class="row justify-content-md-center">
        <div class="form-group col-md-6">
    <h1>Our Barbers</h1>
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="form-group col-md-6">
            <ul>
                @forelse ($barbers as $barber)
                    <li><a href="{{ action('BarbersController@show', [$barber->id]) }}"><h3>{{ $barber->name }}</h3></a></li>
                @empty
                    <li><h3>No barbers are registered in our database.</h3></li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection

