@extends('layouts.app')

@section('content')
    <div class="update-walkins-form" style="font-size:1.2em;font-weight:bolder;">
        <div class="row justify-content-md-center">
            <h1>Walk-in Signup</h1>
        </div>
        <div class="form-grop">
            {!! Form::open(['url' => 'walkins'], ['class' => 'form']) !!}
            <div class="row justify-content-md-center">
                <div class="form-group col-md-6">
                    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                    {!! Form::text('name', null,
                        [
                            'class' => 'form-control',
                            'placeholder' => 'Enter Name'
                        ])
                    !!}
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="form-group col-md-6">
                    {!! Form::label('service', 'Choose Service Type', ['class' => 'control-label']) !!}
                    {!!  Form::select('service', [
	                    'tr_cut' => 'Traditional Haircut',
	                    'sp_cut' => 'Specialty Haircut',
	                    'beard' => 'Beard Edge-up',
	                    'shave' => 'Full Shave',
	                    'cut_beard' => 'Haircut and Beard Edge-up',
                        'cut_shave' => 'Haircut and Full Shave',
                        ], null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="form-group col-md-6">
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>
            {!! Form::close() !!}
            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    @include('errors.list')
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="alert alert-success col-md-6">
                    <p>Your estimate waiting time is 50 minutes</p>
                </div>
            </div>
        </div>
    </div>

@endsection