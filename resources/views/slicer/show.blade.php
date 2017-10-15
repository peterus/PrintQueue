@extends('layouts.app')

@section('content')
    <h2>{{ $slicer->name }} {{ $slicer->version }}</h2>
    <hr/>
    <p>
        Create at: <b>{{ $slicer->created_at }}</b><br>
        Last update: <b>{{ $slicer->updated_at }}</b><br>
        Command: <b>{{ $slicer->command }}</b>
    </p>
    <p>
        <a href="/slicer/{{ $slicer->id }}/edit">edit</a><br>
        <a href="/slicer/{{ $slicer->id }}/destroy">delete</a>
    </p>

    @include('errors.list')

    <hr/>

    <h3 class="sub-header">Slicer Settings:</h3>
    <ul>
        @foreach($settings as $setting)
            <li><a href="/slicersetting/{{ $setting->id }}">{{ $setting->name }}</a></li>
        @endforeach
    </ul>

    <p><a href="/slicer/{{ $slicer->id }}/setting/create">Create</a></p>

@stop
