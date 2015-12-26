<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use Request;

use App\Http\Requests;
use App\Project;
use App\PrintJob;

class PrintJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        $jobs = $project->PrintJob;
        return view('print_job.index', compact('jobs'));
    }

    public function index_all()
    {
        $jobs = PrintJob::All();
        return view('print_job.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('print_job.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrintJobRequest $request)
    {
        PrintJob::create($request->all());
        return redirect('projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PrintJob $printjob)
    {
        return $printjob;
        return view('print_job.show', compact('printjob'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PrintJob $printjob)
    {
        return view('print_job.edit', compact('printjob'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PrintJobRequest $request, PrintJob $printjob)
    {
        $printjob->update($request->all());
        return redirect('projects');
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
        return redirect('projects');
    }
}
