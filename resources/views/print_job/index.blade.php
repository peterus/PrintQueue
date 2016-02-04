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
                    @foreach($settings as $setting)
                        <td>{{ App\PrintTime::where('print_job_id', '=', $job->id)->where('slicer_setting_id', '=', $setting->id)->first()->PrintTime() }}</td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop