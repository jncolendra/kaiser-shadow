<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Blade::setContentTags('<%', '%>'); // Removes Blade {{}}
Blade::setEscapedContentTags('<%%', '%%>'); // for escaped data
Route::get('/', function()
{
	return View::make('tasker');
});
Route::get('getTasks', function(){
	return Task::all();
});

Route::post('tasks', function(){
	$task = new Task;
	$task->task_name = Input::get("task_name");
	$task->task_status = Input::get("task_status");
	$task->save();
});