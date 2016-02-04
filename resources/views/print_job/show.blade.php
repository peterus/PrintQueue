@extends('layouts.app')

@section('content')
    <h2>{{ $printjob->name }}</h2>
    <hr/>
    <p>
        Create at: <b>{{ $printjob->created_at }}</b><br>
        Last update: <b>{{ $printjob->updated_at }}</b><br>
        Quantity: <b>{{ $printjob->quantity }}</b>
    </p>

    <p><a href="/printjob/{{ $printjob->id }}/edit">edit</a></p>

    <hr/>

    {!! Form::model($printjob, ['method' => 'DELETE', 'action' => ['PrintJobController@destroy', $printjob->id]]) !!}
    <div class="form-group">
        {!! Form::submit("Delete Print Job", ['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}

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
                    <td>{{ App\PrintTime::where('print_job_id', '=', $printjob->id)->where('slicer_setting_id', '=', $setting->id)->first()->PrintTime() }}</td>
                @endforeach
            </tr>
            </tbody>
        </table>
    </div>
@stop