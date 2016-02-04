@extends('layouts.app')

@section('content')
    <h1>Saved projects:</h1>
    <ul>
        @foreach($projects as $project)
            <li><a href="/projects/{{ $project->id }}">{{ $project->name }}</a></li>
        @endforeach
    </ul>

    <hr/>

    <p><a href="/projects/create">Create</a></p>
@stop