@extends('layouts.app')

@section('content')
    <div class="create-worklog-form" style="font-size:1.2em;font-weight:bolder;">
        <div class="row justify-content-md-center">
            <h1>Please Take Next Person In Line</h1>
        </div>
        <div class="form-grop">
            {!! Form::open(['url' => 'worklog'], ['class' => 'form']) !!}
            <div class="row justify-content-md-center">
                <div class="form-group col-md-6">
                    {!! Form::label('name', 'Barber', ['class' => 'control-label']) !!}
                    {!! Form::text('name', null,
                        [
                            'class' => 'form-control',
                            'placeholder' => 'Employee Name'
                        ])
                    !!}
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="form-group col-md-6">
                    {!! Form::submit('Next Customer', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>
            {!! Form::close() !!}
            <div class="row justify-content-md-center">
                <div class="form-group col-md-6">
                    @include('errors.list')
                </div>
            </div>
        </div>
    </div>
@endsection
