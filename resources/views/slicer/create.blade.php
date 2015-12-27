@extends('main')

@section('content')

    <h1>Create a new Slicer</h1>

    <hr/>

    {!! Form::open(['url' => 'slicer']) !!}

    @include('slicer.form', ['submitButtonText' => 'Add Slicer'])

    {!! Form::close() !!}

    @include('errors.list')

@stop