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
                'placeholder' => 'Example: 123-456-7890'
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
<div class="row justify-content-md-center">
    <div class="form-group col-md-6">
        {!! Form::submit('Add Barber', ['class' => 'btn btn-primary form-control']) !!}
    </div>
</div>
