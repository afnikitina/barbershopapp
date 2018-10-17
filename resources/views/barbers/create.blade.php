@extends('layouts.app')

@section('content')
    <div class="create-barber-form" style="font-size:1.2em;font-weight:bolder;">
    <div class="row justify-content-md-center">
        <h1>Add a New Barber</h1>
    </div>
    <div class="form-grop">
    {!! Form::open(['route' => 'barbers.create'], ['class' => 'form']) !!}
        <div class="row justify-content-md-center">
            <div class="form-group col-md-6">
                {!! Form::label('name', 'Full Name', ['class' => 'control-label']) !!}
                {!! Form::text('name', null,
                    [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Full Name'
                    ])
                !!}
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="form-group col-md-6">
                {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
                {!! Form::text('address', null,
                    [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Address'
                    ])
                !!}
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="form-group col-md-6">
                {!! Form::label('email', 'Email Address', ['class' => 'control-label']) !!}
                {!! Form::email('email', null,
                    [
                        'class' => 'form-control',
                        'placeholder' => 'Example: example@gmail.com'
                    ])
                !!}
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="form-group col-md-6">
                {!! Form::label('phone', 'Phone Number', ['class' => 'control-label']) !!}
                {!! Form::text('phone', null,
                    [
                        'class' => 'form-control',
                        'placeholder' => 'Example: 123-456-7890',
                        'pattern' => '[0-9]{3}(-)?[0-9]{3}(-)?[0-9]{4}'
                    ])
                !!}
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="form-group col-md-6">
                {!! Form::label('ast', 'Average Service Time (min)', ['class' => 'control-label']) !!}
                {!! Form::number('ast', null,
                    [
                        'class' => 'form-control',
                        'placeholder' => 'Example: 25 (just number, no other characters are allowed)'
                    ])
                !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    </div>
@endsection