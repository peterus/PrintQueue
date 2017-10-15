<?php

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', 'HomeController@index');
    Route::get('/home', function () {
        return redirect('/');
    });

    Route::get('projects', 'ProjectController@index');
    Route::post('projects', 'ProjectController@store');
    Route::get('projects/create', 'ProjectController@create');
    Route::get('projects/{projects}/destroy', 'ProjectController@destroy');
    Route::patch('projects/{projects}', 'ProjectController@update');
    Route::get('projects/{projects}', 'ProjectController@show');
    Route::get('projects/{projects}/edit', 'ProjectController@edit');
    Route::get('projects/{projects}/printjob', 'PrintJobController@project_index');
    Route::get('projects/{projects}/printjob/create', 'PrintJobController@create');
    Route::post('projects/{projects}/printjob', 'PrintJobController@store');

    Route::get('printjob', 'PrintJobController@index');
    Route::get('printjob/{printjob}/destroy', 'PrintJobController@destroy');
    Route::patch('printjob/{printjob}', 'PrintJobController@update');
    Route::get('printjob/{printjob}', 'PrintJobController@show');
    Route::get('printjob/{printjob}/edit', 'PrintJobController@edit');
    Route::get('printjob/{printjob}/addoneprint', 'PrintJobController@addoneprint');


    Route::get('slicer', 'SlicerController@index');
    Route::post('slicer', 'SlicerController@store');
    Route::get('slicer/create', 'SlicerController@create');
    Route::get('slicer/{slicer}/destroy', 'SlicerController@destroy');
    Route::patch('slicer/{slicer}', 'SlicerController@update');
    Route::get('slicer/{slicer}', 'SlicerController@show');
    Route::get('slicer/{slicer}/edit', 'SlicerController@edit');
    Route::get('slicer/{slicer}/setting', 'SlicerSettingController@slicer_index');
    Route::get('slicer/{slicer}/setting/create', 'SlicerSettingController@create');
    Route::post('slicer/{slicer}/setting', 'SlicerSettingController@store');

    Route::get('slicersetting', 'SlicerSettingController@index');
    Route::get('slicersetting/{slicersetting}/destroy', 'SlicerSettingController@destroy');
    Route::patch('slicersetting/{slicersetting}', 'SlicerSettingController@update');
    Route::get('slicersetting/{slicersetting}', 'SlicerSettingController@show');
    Route::get('slicersetting/{slicersetting}/edit', 'SlicerSettingController@edit');

    Route::get('stl/{filename}', function ($filename)
    {
        $path = storage_path("app/".$filename);

        if(!File::exists($path)) abort(404);

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    });

    View::composer('layouts.menu', function ($view) {
        $view->with('menu_projects', App\Project::all());
    });
    View::composer('layouts.menu', function ($view) {
        $view->with('menu_slicer', App\Slicer::all());
    });
});

