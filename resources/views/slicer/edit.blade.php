@extends('layouts.app')

@section('content')

    <h1>Edit: {{ $slicer->name }}</h1>

    <hr/>

    {!! Form::model($slicer, ['method' => 'PATCH', 'action' => ['SlicerController@update', $slicer->id]]) !!}

    @include('slicer.form', ['submitButtonText' => 'Update Slicer'])

    {!! Form::close() !!}

    @include('errors.list')

@stop