@extends('layouts.app')

@section('content')
    <h2>{{ $setting->name }}</h2>
    <hr/>
    <p>
        Create at: <b>{{ $setting->created_at }}</b><br>
        Last update: <b>{{ $setting->updated_at }}</b>
    </p>

    <p>
        <a href="/slicersetting/{{ $setting->id }}/edit">edit</a><br>
        <a href="/slicersetting/{{ $setting->id }}/destroy">delete</a>
    </p>

    @include('errors.list')
@stop