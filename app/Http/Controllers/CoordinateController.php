<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCoordinateRequest;
use App\Http\Requests\UpdateCoordinateRequest;
use App\Models\Coordinate;

class CoordinateController extends Controller
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
     * @param  \App\Http\Requests\StoreCoordinateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoordinateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coordinate  $coordinate
     * @return \Illuminate\Http\Response
     */
    public function show(Coordinate $coordinate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coordinate  $coordinate
     * @return \Illuminate\Http\Response
     */
    public function edit(Coordinate $coordinate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCoordinateRequest  $request
     * @param  \App\Models\Coordinate  $coordinate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoordinateRequest $request, Coordinate $coordinate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coordinate  $coordinate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coordinate $coordinate)
    {
        //
    }
}
