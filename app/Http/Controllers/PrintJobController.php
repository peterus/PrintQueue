<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrintJobRequest;
use Request;
use App\SlicerSetting;

use App\Http\Requests;
use App\Project;
use App\PrintJob;

use App\Jobs\ProcessSTL;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Auth;

class PrintJobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Project $project
     * @return \Illuminate\Http\Response
     */
    public function project_index(Project $project)
    {
        $jobs = $project->PrintJob;
        return view('print_job.project_index', compact('jobs', 'project'))->with('menu_project', $project);
    }

    public function index()
    {
        //$jobs = Auth::user()->Project()->PrintJob;
        $jobs = PrintJob::All();
        $settings = SlicerSetting::All();
        return view('print_job.index', compact('jobs', 'settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        $quantity = 1;
        $prints_done = 0;
        return view('print_job.create', compact('project', 'quantity', 'prints_done'))->with('menu_project', $project);
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
        $job->name = $file->getClientOriginalName();
        $job->file_name = $file->getFilename();
        $job->file_extension = ".".$extension;
        $project->PrintJob()->save($job);

        foreach(SlicerSetting::All() as $setting)
        {
            $this->dispatch(new ProcessSTL($job, $setting));
        }

        return redirect('printjob/'.$job->id);
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
        $settings = SlicerSetting::All();
        return view('print_job.show', compact('printjob', 'settings'))->with('menu_project', $printjob->project);
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
        $quantity = $printjob->quantity;
        $prints_done = $printjob->prints_done;
        return view('print_job.edit', compact('printjob', 'quantity', 'prints_done'))->with('menu_project', $printjob->project);
    }

    public function addoneprint(PrintJob $printjob)
    {
        $printjob->prints_done += 1;
        $printjob->update();
        return redirect('printjob/'.$printjob->id);
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
        if($request->file_name != "" && Storage::disk('local')->exists($printjob->file_name.$printjob->file_extension))
        {
            array_map('unlink', glob(storage_path("app/".$printjob->file_name."*")));
        }
        $printjob->update($request->all());

        $file = Request::file('stl');
        if($file != null)
        {
            $extension = $file->getClientOriginalExtension();
            $new_filename = $file->getFilename().'.'.$extension;
            Storage::disk('local')->put($new_filename, File::get($file));

            $printjob->name = $file->getClientOriginalName();
            $printjob->file_name = $file->getFilename();
            $printjob->file_extension = ".".$extension;
            $printjob->save();

            foreach(SlicerSetting::All() as $setting)
            {
                $this->dispatch(new ProcessSTL($printjob, $setting));
            }
        }

        return redirect('printjob/'.$printjob->id);
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
