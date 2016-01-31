<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('version', 'Version:') !!}
    {!! Form::text('version', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('command', 'Command:') !!}
    {!! Form::text('command', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>