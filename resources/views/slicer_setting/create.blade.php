@extends('layouts.app')

@section('content')

    <h1>Create a new Slicer Setting</h1>

    <hr/>

    {!! Form::open(['url' => 'slicer/'.$slicer->id.'/setting', 'files' => true]) !!}

    @include('slicer_setting.form', ['submitButtonText' => 'Add Slicer Setting'])

    {!! Form::close() !!}

    @include('errors.list')

@stop