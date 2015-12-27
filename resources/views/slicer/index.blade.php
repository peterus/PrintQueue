@extends('main')

@section('content')
    <h1>Saved Slicers:</h1>
    <ul>
        @foreach($slicers as $slicer)
            <li><a href="slicer/{!! $slicer->id !!}">{!! $slicer->name !!}</a></li>
        @endforeach
    </ul>
@stop