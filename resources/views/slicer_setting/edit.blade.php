@extends('main')

@section('content')

    <h1>Edit: {!! $setting->name !!}</h1>

    <hr/>

    {!! Form::model($setting, ['method' => 'PATCH', 'action' => ['SlicerSettingController@update', $setting->id], 'files' => true]) !!}

    @include('slicer_setting.form', ['submitButtonText' => 'Update Slicer Setting'])

    {!! Form::close() !!}

    @include('errors.list')

@stop