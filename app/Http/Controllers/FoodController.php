<?php

namespace App\Http\Controllers;

use App\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::all()->where('user_id', auth()->user()->id);
        //return $routines->toJson(JSON_PRETTY_PRINT);
        return view('foods/index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('foods/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $requestArr = $request->all();
        $food = new Food();
        $food->user_id = auth()->user()->id;
        $food->name = $requestArr['name'];
        $food->description = $requestArr['description'];
        $food->calories = $requestArr['calories'];
        $food->protein = $requestArr['protein'];

        $food->save();

        return redirect('/food');
        //return $requestArr;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $food = Food::findOrFail($id);
        return view('foods/show', compact('food'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $food = Food::findOrFail($id);
        return view('foods/edit', compact('food'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $user->foods()->whereId($id)->delete();

        $requestArr = $request->all();
        $food = new Food();
        $food->user_id = auth()->user()->id;
        $food->name = $requestArr['name'];
        $food->description = $requestArr['description'];
        $food->calories = $requestArr['calories'];
        $food->protein = $requestArr['protein'];

        $food->save();

        return redirect('/food');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $user->foods()->whereId($id)->delete();

        return redirect('/food');
    }
}
