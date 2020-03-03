<?php

namespace App\Http\Controllers;

use App\Measurment;
use Illuminate\Http\Request;
use App\Tracker;

class MeasurmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $data = new Measurment();
        $data->value = $request->value;
        $data->tracker_id = $id;
        $data->save();

        return redirect('/trackers/'.$id.'/measurment');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Measurment  $measurment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tracker = new Measurment();
        $tracker->tracker_id = $id;
        $tracker2 = \DB::table('trackers')->where('id', $id)->select('unit_type')->first()->unit_type;
        $results = Measurment::all()->where('tracker_id', $id);

        return view('trackers/show', compact('tracker', 'results', 'tracker2'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Measurment  $measurment
     * @return \Illuminate\Http\Response
     */
    public function edit(Measurment $measurment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Measurment  $measurment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Measurment $measurment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Measurment  $measurment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Measurment $measurment)
    {
        //
    }
}
