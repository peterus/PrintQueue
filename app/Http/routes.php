<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect('projects');
});

Route::resource('slicer', 'SlicerController');
Route::resource('slicersetting', 'SlicerSettingController', ['except' => [
    'create', 'store',
]]);
Route::get('slicer/{slicer}/setting', 'SlicerSettingController@slicer_index')->name('slicersetting.slicer_index');
Route::get('slicer/{slicer}/setting/create', 'SlicerSettingController@create')->name('slicersetting.create');
Route::post('slicer/{slicer}/setting', 'SlicerSettingController@store')->name('slicersetting.store');

Route::resource('projects', 'ProjectController');
Route::resource('printjob', 'PrintJobController', ['except' => [
    'create', 'store',
]]);
Route::get('projects/{projects}/printjob', 'PrintJobController@project_index')->name('printjob.project_index');
Route::get('projects/{projects}/printjob/create', 'PrintJobController@create')->name('printjob.create');
Route::post('projects/{projects}/printjob', 'PrintJobController@store')->name('printjob.store');