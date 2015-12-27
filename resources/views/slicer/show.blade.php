@extends('main')

@section('content')
    <h2>{!! $slicer->name !!}</h2>
    <hr/>
    <p>
        Create at: <b>{!! $slicer->created_at !!}</b><br>
        Last update: <b>{!! $slicer->updated_at !!}</b><br>
        Command: <b>{!! $slicer->command !!}</b>
    </p>

    <hr/>

    {!! Form::model($slicer, ['method' => 'DELETE', 'action' => ['SlicerController@destroy', $slicer->id]]) !!}
    <div class="form-group">
        {!! Form::submit("Delete Slicer", ['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}

    @include('errors.list')
@stop