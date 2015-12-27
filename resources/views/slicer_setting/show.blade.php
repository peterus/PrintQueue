@extends('main')

@section('content')
    <h2>{!! $setting->name !!}</h2>
    <hr/>
    <p>Create at: <b>{!! $setting->created_at !!}</b><br>
        Last update: <b>{!! $setting->updated_at !!}</b></p>

    <hr/>

    {!! Form::model($setting, ['method' => 'DELETE', 'action' => ['SlicerSettingController@destroy', $setting->id]]) !!}
    <div class="form-group">
        {!! Form::submit("Delete Slicer Setting", ['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}

    @include('errors.list')
@stop