@extends('layouts.app')

@section('content')
    <h2>{{ $project->name }}</h2>
    <hr/>
    <p>
        Create at: <b>{{ $project->created_at }}</b><br>
        Last update: <b>{{ $project->updated_at }}</b>
    </p>
    <p>
        <a href="/projects/{{ $project->id }}/edit">edit</a><br>
        <a href="/projects/{{ $project->id }}/destroy">delete</a>
    </p>

    @include('errors.list')

    <hr/>


    <h3 class="sub-header">Print Jobs</h3>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Jobs</th>
                <th>Quantity</th>
                <th>Prints done</th>
                @foreach($settings as $setting)
                    <th>{{ $setting->name }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($jobs as $job)
                <tr>
                    <td><a href="/printjob/{{ $job->id }}">{{ $job->name }}</a></td>
                    <td>{{ $job->quantity }}</td>
                    <td>{{ $job->prints_done }}</td>
                    @foreach($settings as $setting)
                        <td>{{ App\PrintTime::get($job, $setting) }}</td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <p><a href="/projects/{{ $project->id }}/printjob/create">Create</a></p>
@stop