@extends('layouts.app')

@section('content')
    <h2 class="sub-header">Print Jobs</h2>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Project</th>
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
                    <td><a href="/projects/{{ $job->Project->id }}">{{ $job->Project->name }}</a></td>
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
@stop