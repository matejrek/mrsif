<?php

namespace App\Http\Controllers;

use App\TrackerResult;
use Illuminate\Http\Request;

use Carbon\Carbon;

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
        $unit = \DB::table('trackers')->where('id', $id)->select('unit_type')->first()->unit_type;
        $results = TrackerResult::all()->where('tracker_id', $id);

        $init=1;

        if( !($results->isEmpty()) ){
            $init=0;
            //$chart = array();
            $chartTitle = \DB::table('trackers')->where('id', $id)->select('name')->first()->name;

            $chartLabel = array();
            $chartData = array();
            foreach($results as $item){
                //array_push( $chart, array($item->updated_at->format('Y-m-d'), $item->value) );
                array_push($chartLabel, $item->updated_at->format('Y-m-d'));
                array_push($chartData, $item->value);
            }

            //is last record 24h old
            $lastResult = TrackerResult::all()->where('tracker_id', $id)->sortByDesc('created_at')->first();
            $lastDateTime = $lastResult->created_at;
            $now = Carbon::now();
            $lastResultId = $lastResult->id;

            //interval in hours
            $interval = \DB::table('trackers')->where('id', $id)->select('interval')->first()->interval;

            //if interval is less than 24h, then add info in daily sum (for calories)

            $canAddNew = 0;
            $diff = $lastDateTime->diffInHours($now);
            //if( !($lastDateTime->isToday()) ){
            if($diff > $interval){
                $canAddNew = 1;
            }

            return view('trackers/show', compact('tracker', 'results', 'unit', 'chartLabel', 'chartData', 'chartTitle', 'canAddNew', 'diff', 'lastResultId', 'init', 'interval', 'id'));
        }
        else{
            return view('trackers/show', compact('tracker','init', 'id'));
        }

        /*$chart = array();
        $chartTitle = \DB::table('trackers')->where('id', $id)->select('name')->first()->name;

        foreach($results as $item){
            array_push( $chart, array($item->updated_at->format('Y-m-d'), $item->value) );
        }

        //is last record 24h old
        $lastResult = TrackerResult::all()->where('tracker_id', $id)->sortByDesc('created_at')->first();
        $lastDateTime = $lastResult->created_at;
        $now = Carbon::now();
        $lastResultId = $lastResult->id;

        $canAddNew = 0;
        $diff = $lastDateTime->diffInHours($now);
        if( !($lastDateTime->isToday()) ){
            $canAddNew = 1;
        }

        return view('trackers/show', compact('tracker', 'results', 'unit', 'chart', 'chartTitle', 'canAddNew', 'diff', 'lastResultId'));*/
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
    public function update(Request $request, $id)
    {
        $user = auth()->user();

        $trackerId = \DB::table('tracker_results')->where('id', $id)->select('tracker_id')->first()->tracker_id;
        $trackerOwner = \DB::table('trackers')->where('id', $trackerId)->select('user_id')->first()->user_id;
        $tracker_result = TrackerResult::findOrFail($id);

        if( $trackerOwner == ($user->id) ){
            $tracker_result->update($request->all());
        }
        return redirect('trackers/'.$trackerId.'/result');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TrackerResult  $trackerResult
     * @return \Illuminate\Http\Response
     */
    public function destroy($lastResultId)
    {
        $user = auth()->user();

        $trackerId = \DB::table('tracker_results')->where('id', $lastResultId)->select('tracker_id')->first()->tracker_id;
        $trackerOwner = \DB::table('trackers')->where('id', $trackerId)->select('user_id')->first()->user_id;

        if( $trackerOwner == ($user->id) ){
            $result = \DB::table('tracker_results')->where('id', $lastResultId)->delete();
        }

        return redirect('trackers/'.$trackerId.'/result');
    }

    public function weekly($id){
        $user = auth()->user();

        $trackerId = \DB::table('tracker_results')->where('id', $id)->select('tracker_id')->first()->tracker_id;
        $trackerOwner = \DB::table('trackers')->where('id', $trackerId)->select('user_id')->first()->user_id;

        if( $trackerOwner == ($user->id) ){
            $trackers = TrackerResult::all()
                //->where('user_id', '=', auth()->user()->id)
                ->where('tracker_id', $id)
                ->where('created_at', '>=', Carbon::now()->subDays(7))
                ->sortBy('created_at');
        }

        return $trackers;
    }    

    public function monthly($id){
        $user = auth()->user();

        $trackerId = \DB::table('tracker_results')->where('id', $id)->select('tracker_id')->first()->tracker_id;
        $trackerOwner = \DB::table('trackers')->where('id', $trackerId)->select('user_id')->first()->user_id;

        if( $trackerOwner == ($user->id) ){
            $trackers = TrackerResult::all()
                ->where('tracker_id', $id)
                ->where('created_at', '>=', Carbon::now()->subDays(30))
                ->sortBy('created_at');
        }

        return $trackers;
    } 

    public function all($id){
        $user = auth()->user();

        $trackerId = \DB::table('tracker_results')->where('id', $id)->select('tracker_id')->first()->tracker_id;
        $trackerOwner = \DB::table('trackers')->where('id', $trackerId)->select('user_id')->first()->user_id;

        if( $trackerOwner == ($user->id) ){
            $trackers = TrackerResult::all()
                ->where('tracker_id', $id)
                ->sortBy('created_at');
        }

        return $trackers;
    }   
}
