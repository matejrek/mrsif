<?php

namespace App\Http\Controllers;

use App\Routine;
use Illuminate\Http\Request;

use App\Section;
use App\Exercise;
use Illuminate\Support\Str;
use Validator;

class RoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routines = Routine::all()->where('user_id', auth()->user()->id);
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
        $this->validate($request, [
            'name'=>'required|min:3',
            'description'=>'required|string',
            'sections.*.name'=>'required|min:3',
            'sections.*.description'=>'required|string'
        ]);

        $requestArr = $request->all();
        $routine = new Routine();
        $routine->user_id = auth()->user()->id;
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
    public function show($id)
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
    public function edit($id)
    {
        $routine = Routine::findOrFail($id);
        return view('routines/edit', compact('routine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Routine  $routine
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, Routine $routine)
    public function update(Request $request, $id)
    {
        /*$routine = Routine::findOrFail($id);
        $routine->updateOrCreate($request->all());*/
        //return $routine;
        
        //return $request->all();

        $user = auth()->user();
        $user->routines()->whereId($id)->delete();


        $requestArr = $request->all();
        $routine = new Routine();
        $routine->user_id = auth()->user()->id;
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Routine  $routine
     * @return \Illuminate\Http\Response
     */
    //public function destroy(Routine $routine)
    public function destroy($id)
    {
        $user = auth()->user();

        //$user->routines()->sections()->where('',$id)->sections()->->delete();

        /*$sections = $user->routines()->whereId($id)->sections();*/

        $user->routines()->whereId($id)->delete();

        return redirect('/routines');
    }
}
