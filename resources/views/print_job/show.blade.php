@extends('main')

@section('content')
    <h2>{!! $printjob->name !!}</h2>
    <hr/>
    <p>
        Create at: <b>{!! $printjob->created_at !!}</b><br>
        Last update: <b>{!! $printjob->updated_at !!}</b>
    </p>

    <p><a href="/printjob/{!! $printjob->id !!}/edit">edit</a></p>

    <hr/>

    {!! Form::model($printjob, ['method' => 'DELETE', 'action' => ['PrintJobController@destroy', $printjob->id]]) !!}
    <div class="form-group">
        {!! Form::submit("Delete Print Job", ['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}

    @include('errors.list')
@stop