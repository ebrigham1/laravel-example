<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('projects', 'ProjectController@index')->name('projects');
Route::post('projects', 'ProjectController@store')->name('storeProject');
Route::get('projects/{id}', 'ProjectController@show')->name('viewProject');
Route::put('projects/{project}', 'ProjectController@markAsCompleted')->name('completeProject');
Route::post('tasks', 'TaskController@store')->name('storeTask');
Route::put('tasks/{task}', 'TaskController@markAsCompleted')->name('completeTask');
