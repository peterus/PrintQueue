<?php

namespace App\Http\Controllers;

use App\Http\Requests\SlicerSettingRequest;
use Request;

use App\Http\Requests;
use App\Slicer;
use App\SlicerSetting;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class SlicerSettingController extends Controller
{
    public function slicer_index(Slicer $slicer)
    {
        $settings = $slicer->Setting;
        return view('slicer_setting.index', compact('settings', 'slicer'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = SlicerSetting::All();
        return view('slicer_setting.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Slicer $slicer)
    {
        return view('slicer_setting.create', compact('slicer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Slicer $slicer
     * @param SlicerSettingRequest|\Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Slicer $slicer, SlicerSettingRequest $request)
    {
        $file = Request::file('config');
        $extension = $file->getClientOriginalExtension();
        $new_filename = $file->getFilename().'.'.$extension;
        Storage::disk('local')->put($new_filename, File::get($file));

        $setting = new SlicerSetting($request->all());
        $setting->file_name = $file->getFilename();
        $setting->file_extension = ".".$extension;
        $slicer->Setting()->save($setting);
        return redirect('slicersetting');
    }

    /**
     * Display the specified resource.
     *
     * @param SlicerSetting $setting
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(SlicerSetting $setting)
    {
        return view('slicer_setting.show', compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SlicerSetting $setting
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(SlicerSetting $setting)
    {
        return view('slicer_setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SlicerSettingRequest|\Illuminate\Http\Request $request
     * @param SlicerSetting $setting
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(SlicerSettingRequest $request, SlicerSetting $setting)
    {
        if($setting->file_name != "" && Storage::disk('local')->exists($setting->file_name.$setting->file_extension))
        {
            Storage::disk('local')->delete($setting->file_name.$setting->file_extension);
        }

        $file = Request::file('config');
        $extension = $file->getClientOriginalExtension();
        $new_filename = $file->getFilename().'.'.$extension;
        Storage::disk('local')->put($new_filename, File::get($file));

        $setting->update($request->all());
        $setting->file_name = $file->getFilename();
        $setting->file_extension = ".".$extension;
        $setting->save();
        return redirect('slicersetting');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SlicerSetting $setting
     * @return \Illuminate\Http\Response
     * @throws \Exception
     * @internal param int $id
     */
    public function destroy(SlicerSetting $setting)
    {
        $setting->delete();
        return redirect('slicersetting');
    }
}
