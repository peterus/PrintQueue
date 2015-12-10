@extends('main')

@section('content')

    <h1>Create a new Project</h1>

    <hr/>

    {!! Form::open(['url' => 'project']) !!}

    @include('project.form', ['submitButtonText' => 'Add Project'])

    {!! Form::close() !!}

    @include('errors.list')

@stop