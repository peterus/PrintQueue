@extends('main')

@section('content')
    <h1>Saved projects:</h1>
    <ul>
        @foreach($projects as $project)
            <li>{!! $project->name !!}</li>
        @endforeach
    </ul>
@stop