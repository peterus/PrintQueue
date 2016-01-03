<?php

namespace App\Http\Controllers;

use App\Http\Requests\SlicerSettingRequest;
use Request;

use App\Http\Requests;
use App\Slicer;
use App\SlicerSetting;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Slicer $slicer, SlicerSettingRequest $request)
    {
        $setting = new SlicerSetting($request->all());
        $slicer->Setting()->save($setting);
        return redirect('slicersetting');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SlicerSetting $setting)
    {
        return view('slicer_setting.show', compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SlicerSetting $setting)
    {
        return view('slicer_setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SlicerSettingRequest $request, SlicerSetting $setting)
    {
        $setting->update($request->all());
        return redirect('slicersetting');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SlicerSetting $setting)
    {
        $setting->delete();
        return redirect('slicersetting');
    }
}
