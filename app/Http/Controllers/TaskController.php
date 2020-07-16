<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //remove all tasks older than today 
        /*$rmtasks = Task::all()
            ->where('user_id', '=', auth()->user()->id)
            ->where('dateTime', '<', Carbon::now());

        foreach($rmtasks as $rmtask){
            $rmtask->delete();
        }*/
        //add timezone at registration, on load read timezone to preselect, add user edit options with delete for gdpr
        
        
        //dont delete, let cron do it
        //\DB::table('tasks')->where('user_id', auth()->user()->id)->where('dateTime', '<', Carbon::now('UTC'))->delete();

        //list all tasks
        $tasks = Task::all()
            ->where('user_id', '=', auth()->user()->id)
            ->where('completed', '=', 0)
            ->where('dateTime', '>=', Carbon::now('UTC'));

        $overdueTasks = Task::all()
            ->where('user_id', '=', auth()->user()->id)
            ->where('completed', '=', 0)
            ->where('dateTime', '<', Carbon::now('UTC'));    


        return view('tasks/index', compact('tasks', 'overdueTasks'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestArr = $request->all();
        $task = new Task();
        $task->user_id = auth()->user()->id;
        $task->name = $requestArr['name'];
        $task->description = $requestArr['description'];
        $task->dateTime = $requestArr['dateTime'];
        /*if( $requestArr['recurring'] ){
            $task->recurring = $requestArr['recurring'];
        }
        else{
            $task->recurring = 0;
        } */
        $task->save();
        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, Task $task)
    public function update($id)
    {
        $user = auth()->user();

        $user->tasks()->whereId($id)->update(['completed' => 1]);

        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();

        $user->tasks()->whereId($id)->delete();

        return redirect('/tasks');
    }
}
