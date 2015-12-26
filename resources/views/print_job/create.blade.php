@extends('main')

@section('content')

    <h1>Create a new Print Job</h1>

    <hr/>

    {!! Form::open(['url' => 'projects/'.$project->id.'/printjob']) !!}

    @include('print_job.form', ['submitButtonText' => 'Add Print Job'])

    {!! Form::close() !!}

    @include('errors.list')

@stop