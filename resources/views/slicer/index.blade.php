@extends('layouts.app')

@section('content')
    <h1>Saved Slicers:</h1>
    <ul>
        @foreach($slicers as $slicer)
            <li><a href="slicer/{{ $slicer->id }}">{{ $slicer->name }} {{ $slicer->version }}</a></li>
        @endforeach
    </ul>

    <hr/>

    <p><a href="/slicer/create">Create</a></p>
@stop