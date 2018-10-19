<div class="row justify-content-md-center">
    <div class="form-group col-md-6">
        {!! Form::label('name', 'Full Name', ['class' => 'control-label']) !!}
        {!! Form::text('name', $valName,
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
        {!! Form::text('address', $valAddress,
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
        {!! Form::email('email', $valEmail,
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
        {!! Form::text('phone', $valPhone,
            [
                'class' => 'form-control',
                'placeholder' => 'Example: 123-456-7890'
            ])
        !!}
    </div>
</div>
<div class="row justify-content-md-center">
    <div class="form-group col-md-6">
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
    </div>
</div>
