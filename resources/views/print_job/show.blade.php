@extends('layouts.app')

@section('content')
    <h2>{{ $printjob->name }}</h2>
    <hr/>
    <p>
        Create at: <b>{{ $printjob->created_at }}</b><br>
        Last update: <b>{{ $printjob->updated_at }}</b><br>
        Quantity: <b>{{ $printjob->quantity }}</b><br>
        Prints done: <b>{{ $printjob->prints_done }}</b> (<a href="/printjob/{{ $printjob->id }}/addoneprint">++</a>)
    </p>

    <p>
        <a href="/printjob/{{ $printjob->id }}/edit">edit</a><br>
        <a href="/printjob/{{ $printjob->id }}/destroy">delete</a>
    </p>

    <p>
        <iframe id="vs_iframe"
                src="http://www.viewstl.com/?embedded&rotation=yes&url={{ url('stl/'.$printjob->file_name.$printjob->file_extension) }}&orientation=top"
                style="border:0;margin:0;width:100%;height:500px;"></iframe>
    </p>

    @include('errors.list')

    <hr/>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Jobs</th>
                @foreach($settings as $setting)
                    <th>{{ $setting->name }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $printjob->name }}</td>
                @foreach($settings as $setting)
                    <td>{{ App\PrintTime::get($printjob, $setting) }}</td>
                @endforeach
            </tr>
            </tbody>
        </table>
    </div>
@stop