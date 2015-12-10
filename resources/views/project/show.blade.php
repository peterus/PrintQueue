@extends('main')

@section('content')
    <h2>{!! $project->name !!}</h2>
    <hr\>
    <p>Create at: <b>{!! $project->created_at !!}</b><br>
    Last update: <b>{!! $project->updated_at !!}</b></p>
@stop