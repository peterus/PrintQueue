<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrintJobRequest;
use Request;

use App\Http\Requests;
use App\Project;
use App\PrintJob;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PrintJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Project $project
     * @return \Illuminate\Http\Response
     */
    public function project_index(Project $project)
    {
        $jobs = $project->PrintJob;
        return view('print_job.index', compact('jobs', 'project'));
    }

    public function index()
    {
        $jobs = PrintJob::All();
        return view('print_job.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        return view('print_job.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PrintJobRequest|\Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Project $project, PrintJobRequest $request)
    {
        $file = Request::file('stl');
        $extension = $file->getClientOriginalExtension();
        $new_filename = $file->getFilename().'.'.$extension;
        Storage::disk('local')->put($new_filename, File::get($file));

        $job = new PrintJob($request->all());
        $job->stl = $new_filename;
        $project->PrintJob()->save($job);
        return redirect('projects/'.$project->id.'/printjob');
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @param PrintJob $printjob
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(PrintJob $printjob)
    {
        return view('print_job.show', compact('printjob'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PrintJob $printjob
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(PrintJob $printjob)
    {
        return view('print_job.edit', compact('printjob'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PrintJobRequest|\Illuminate\Http\Request $request
     * @param PrintJob $printjob
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(PrintJobRequest $request, PrintJob $printjob)
    {
        if($printjob->stl != "" && Storage::disk('local')->exists($printjob->stl))
        {
            Storage::disk('local')->delete($printjob->stl);
        }

        $file = Request::file('stl');
        $extension = $file->getClientOriginalExtension();
        $new_filename = $file->getFilename().'.'.$extension;
        Storage::disk('local')->put($new_filename, File::get($file));

        $printjob->update($request->all());
        $printjob->stl = $new_filename;
        $printjob->save();
        return redirect('printjob');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PrintJob $printjob
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(PrintJob $printjob)
    {
        $printjob->delete();
        return redirect('printjob');
    }
}
