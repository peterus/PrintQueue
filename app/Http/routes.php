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
    Route::delete('projects/{projects}', 'ProjectController@destroy');
    Route::patch('projects/{projects}', 'ProjectController@update');
    Route::get('projects/{projects}', 'ProjectController@show');
    Route::get('projects/{projects}/edit', 'ProjectController@edit');
    Route::get('projects/{projects}/printjob', 'PrintJobController@project_index');
    Route::get('projects/{projects}/printjob/create', 'PrintJobController@create');
    Route::post('projects/{projects}/printjob', 'PrintJobController@store');

    Route::get('printjob', 'PrintJobController@index');
    Route::delete('printjob/{printjob}', 'PrintJobController@destroy');
    Route::patch('printjob/{printjob}', 'PrintJobController@update');
    Route::get('printjob/{printjob}', 'PrintJobController@show');
    Route::get('printjob/{printjob}/edit', 'PrintJobController@edit');


    Route::get('slicer', 'SlicerController@index');
    Route::post('slicer', 'SlicerController@store');
    Route::get('slicer/create', 'SlicerController@create');
    Route::delete('slicer/{slicer}', 'SlicerController@destroy');
    Route::patch('slicer/{slicer}', 'SlicerController@update');
    Route::get('slicer/{slicer}', 'SlicerController@show');
    Route::get('slicer/{slicer}/edit', 'SlicerController@edit');
    Route::get('slicer/{slicer}/setting', 'SlicerSettingController@slicer_index');
    Route::get('slicer/{slicer}/setting/create', 'SlicerSettingController@create');
    Route::post('slicer/{slicer}/setting', 'SlicerSettingController@store');

    Route::get('slicersetting', 'SlicerSettingController@index');
    Route::delete('slicersetting/{slicersetting}', 'SlicerSettingController@destroy');
    Route::patch('slicersetting/{slicersetting}', 'SlicerSettingController@update');
    Route::get('slicersetting/{slicersetting}', 'SlicerSettingController@show');
    Route::get('slicersetting/{slicersetting}/edit', 'SlicerSettingController@edit');


    View::composer('layouts.menu', function ($view) {
        $view->with('menu_projects', App\Project::all());
    });
    View::composer('layouts.menu', function ($view) {
        $view->with('menu_slicer', App\Slicer::all());
    });

});

