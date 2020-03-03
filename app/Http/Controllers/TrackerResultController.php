<?php

namespace App\Http\Controllers;

use App\TrackerResult;
use Illuminate\Http\Request;

class TrackerResultController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'value'=>'required|min:1'
        ],
        [
            'value.required'=>'A value is required'
        ]);


        $data = new TrackerResult();
        $data->value = $request->value;
        $data->tracker_id = $id;
        $data->save();

        return redirect('/trackers/'.$id.'/result');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TrackerResult  $trackerResult
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tracker = new TrackerResult();
        $tracker->tracker_id = $id;
        $tracker2 = \DB::table('trackers')->where('id', $id)->select('unit_type')->first()->unit_type;
        $results = TrackerResult::all()->where('tracker_id', $id);

        return view('trackers/show', compact('tracker', 'results', 'tracker2'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TrackerResult  $trackerResult
     * @return \Illuminate\Http\Response
     */
    public function edit(TrackerResult $trackerResult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TrackerResult  $trackerResult
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TrackerResult $trackerResult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TrackerResult  $trackerResult
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrackerResult $trackerResult)
    {
        //
    }
}
