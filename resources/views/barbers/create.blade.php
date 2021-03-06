@extends('layouts.app')

@section('content')
    <div class="create-barber-form" style="font-size:1.2em;font-weight:bolder;">
        <div class="row justify-content-md-center">
            <h1>Please Create Your Profile</h1>
        </div>
        <div class="form-grop">
        {!! Form::open(['url' => 'barbers'], ['class' => 'form']) !!}
            @include('barbers._form', [
                'submitButtonText' => 'Create Profile',
                'valName' => null,
                'valAddress' => null,
                'valEmail' => null,
                'valPhone' => null
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