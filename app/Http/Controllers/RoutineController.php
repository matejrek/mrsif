<?php

namespace App\Http\Controllers;

use App\Routine;
use Illuminate\Http\Request;

class RoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routines = Routine::all();
        //return $routines->toJson(JSON_PRETTY_PRINT);
        return view('routines/index', compact('routines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $routine = new Routine();
        $routine->user_id = 1;
        $routine->name = $requestArr['name'];
        $routine->description = $requestArr['description'];
        $routine->save();

        $routine_id = $routine->id;

        foreach($requestArr['sections'] as $item){
            $section = new Section();
            $section->name = $item['name'];
            $section->description = $item['description'];
            $section->routine_id = $routine_id;
            $section->save();

            $section_id = $section->id;

            if( array_key_exists( 'exercises', $item ) ){
                foreach($item['exercises'] as $item2){
                    $exercise = new Exercise();
                    $exercise->name = $item2['name'];
                    $exercise->description = $item['description'];
                    $exercise->duration = 60;
                    $exercise->duration_unit = 'seconds';

                    $section->exercises()->save($exercise);
                }
            }
        }


        return redirect('/routines');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Routine  $routine
     * @return \Illuminate\Http\Response
     */
    public function show(Routine $routine)
    {
        $routine = Routine::findOrFail($id);

        return view('routines/show', compact('routine'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Routine  $routine
     * @return \Illuminate\Http\Response
     */
    public function edit(Routine $routine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Routine  $routine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Routine $routine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Routine  $routine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Routine $routine)
    {
        //
    }
}
