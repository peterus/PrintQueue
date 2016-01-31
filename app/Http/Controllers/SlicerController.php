<?php

namespace App\Http\Controllers;

use App\Http\Requests\SlicerRequest;

use App\Http\Requests;
use App\Slicer;

class SlicerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slicers = Slicer::all();
        return view('slicer.index', compact('slicers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('slicer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SlicerRequest|\Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SlicerRequest $request)
    {
        Slicer::create($request->all());
        return redirect('slicer');
    }

    /**
     * Display the specified resource.
     *
     * @param Slicer $slicer
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Slicer $slicer)
    {
        return view('slicer.show', compact('slicer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Slicer $slicer
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Slicer $slicer)
    {
        return view('slicer.edit', compact('slicer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SlicerRequest|\Illuminate\Http\Request $request
     * @param Slicer $slicer
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(SlicerRequest $request, Slicer $slicer)
    {
        $slicer->update($request->all());
        return redirect('slicer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Slicer $slicer
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Slicer $slicer)
    {
        $slicer->delete();
        return redirect('slicer');
    }
}
