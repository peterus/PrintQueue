<?php

namespace App\Http\Controllers;

use App\Project;
use App\SlicerSetting;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Auth::user()->Project;
        return view('project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectRequest|\Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        Auth::user()->Project()->create($request->all());
        return redirect('projects');
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $jobs = $project->PrintJob;
        $settings = SlicerSetting::All();
        return view('project.show', compact('project', 'settings', 'jobs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Project $project
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Project $project)
    {
        return view('project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjectRequest|\Illuminate\Http\Request $request
     * @param Project $project
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->all());
        return redirect('projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect('projects');
    }
}
