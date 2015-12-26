@extends('main')

@section('content')

    <h1>Edit: {!! $printjob->name !!}</h1>

    <hr/>

    {!! Form::model($printjob, ['method' => 'PATCH', 'action' => ['PrintJobController@update', $printjob->id]]) !!}

    @include('print_job.form', ['submitButtonText' => 'Update Print Job'])

    {!! Form::close() !!}

    @include('errors.list')

@stop