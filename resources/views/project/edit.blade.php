@extends('layouts.app')

@section('content')

    <h1>Edit: {{ $project->name }}</h1>

    <hr/>

    {!! Form::model($project, ['method' => 'PATCH', 'action' => ['ProjectController@update', $project->id], 'files' => true]) !!}

    @include('project.form', ['submitButtonText' => 'Update Project'])

    {!! Form::close() !!}

    @include('errors.list')

@stop