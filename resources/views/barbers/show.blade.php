@extends('layouts.app')

@section('title', $barber->name)

@section('content')
    <h1>Barber {{$barber->id}}</h1>
    <h2>{{$barber->name}}</h2>
@endsection