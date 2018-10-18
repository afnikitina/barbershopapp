@extends('layouts.app')

@section('content')
    <div class="update-walkins-form" style="font-size:1.2em;font-weight:bolder;">
        <div class="row justify-content-md-center">
            <h1>Walk-in Signup</h1>
        </div>
        <div class="form-grop">
            {!! Form::open(['url' => 'walkins'], ['class' => 'form']) !!}

            {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
            {!! Form::text('name', null,
                [
                    'class' => 'form-control',
                    'placeholder' => 'Enter Name'
                ])
            !!}

            {!!  Form::select('animal',[
                'Cats' => ['leopard' => 'Leopard'],
                'Dogs' => ['spaniel' => 'Spaniel'],
                ])
             !!}

            {!! Form::close() !!}
            <div class="row justify-content-md-center">
                <div class="form-group col-md-6">
                    @include('errors.list')
                </div>
            </div>
        </div>
    </div>

@endsection