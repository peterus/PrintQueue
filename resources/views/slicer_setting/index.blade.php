@extends('main')

@section('content')
    <h1>Slicer Settings:</h1>
    <ul>
        @foreach($settings as $setting)
            <li><a href="/slicersetting/{!! $setting->id !!}">{!! $setting->name !!}</a></li>
        @endforeach
    </ul>
@stop