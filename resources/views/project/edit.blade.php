@extends('main')

@section('content')

    <h1>Edit: {{ $project->name }}</h1>

    <hr/>

    {!! Form::model($project, ['method' => 'PATCH', 'action' => ['ProjectController@update', $project->id]]) !!}

    @include('project.form', ['submitButtonText' => 'Update Project'])

    {!! Form::close() !!}

    @include('errors.list')

@stop