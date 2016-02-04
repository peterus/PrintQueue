@extends('layouts.app')

@section('content')
    <h1>Print Jobs:</h1>
    <ul>
        @foreach($jobs as $job)
            <li><a href="/printjob/{{ $job->id }}">{{ $job->name }}</a></li>
        @endforeach
    </ul>

    <p><a href="/projects/{{ $project->id }}/printjob/create">Create</a></p>
@stop
