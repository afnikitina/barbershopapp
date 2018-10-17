@extends('layouts.app')

@section('content')
    <div class="create-barber-form" style="font-size:1.2em;font-weight:bolder;">
        <div class="row justify-content-md-center">
            <h1>Edit Profile: {!! $barber->name !!}</h1>
        </div>
        <div class="form-grop">
            {!! Form::model(['method' => 'PATCH', 'action' => ['BarbersController@update', $barber->id], 'class' => 'form']) !!}
            @include('barbers._form', ['submitButtonText' => 'Update Profile'])
            {!! Form::close() !!}
            <div class="row justify-content-md-center">
                <div class="form-group col-md-6">
                    @include('errors.list')
                </div>
            </div>
        </div>
    </div>

@endsection