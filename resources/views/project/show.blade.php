@extends('main')

@section('content')
    <h2>{!! $project->name !!}</h2>
    <hr/>
    <p>Create at: <b>{!! $project->created_at !!}</b><br>
    Last update: <b>{!! $project->updated_at !!}</b></p>

    <hr/>

    {!! Form::model($project, ['method' => 'DELETE', 'action' => ['ProjectController@destroy', $project->id]]) !!}
    <div class="form-group">
        {!! Form::submit("Delete Project", ['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}

    @include('errors.list')
@stop