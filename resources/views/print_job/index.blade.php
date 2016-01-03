@extends('main')

@section('content')
    <h1>Print Jobs:</h1>
    <ul>
        @foreach($jobs as $job)
            <li><a href="/printjob/{!! $job->id !!}">{!! $job->name !!}</a></li>
        @endforeach
    </ul>

    @if(isset($project))
        <p><a href="/projects/{!! $project->id !!}/printjob/create">Create</a></p>
    @endif
@stop