<div class="form-group">
    {!! Form::label('stl', 'STL File:') !!}
    {!! Form::file('stl', ['class' => 'btn btn-default btn-file']) !!}
</div>

<div class="form-group">
    {!! Form::label('quantity', 'Quantity:') !!}
    {!! Form::text('quantity', $quantity, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
