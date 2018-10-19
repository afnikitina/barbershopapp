@extends('layouts.app')

@section('content')
    <div class="create-barber-form" style="font-size:1.2em;font-weight:bolder;">
        <div class="row justify-content-md-center">
            <h1>Edit Profile: {!! $barber->name !!}</h1>
        </div>
        <div class="form-grop">
            {!! Form::model([$barber, 'method' => 'PATCH', 'action' => ['BarbersController@update', $barber->id], 'class' => 'form']) !!}
            @include('barbers._form', ['submitButtonText' => 'Update Profile'])
            @include('barbers._form', [
                'submitButtonText' => 'Update Profile',
                'valName' => old('name', $barber->name),
                'valAddress' => old('address', $barber->address),
                'valEmail' => old('email', $barber->email),
                'valPhone' => old('phone', $barber->phone)
            ])
            {!! Form::close() !!}
            <div class="row justify-content-md-center">
                <div class="form-group col-md-6">
                    @include('errors.list')
                </div>
            </div>
        </div>
    </div>

@endsection