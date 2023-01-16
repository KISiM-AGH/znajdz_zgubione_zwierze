<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\V1\CoordinateResource;
use App\Http\Resources\V1\CoordinateCollection;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\V1\StoreCoordinateRequest;
use App\Http\Requests\V1\UpdateCoordinateRequest;
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
        return new CoordinateCollection(Coordinate::all());   
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
    public function store(/*Request $request*/ StoreCoordinateRequest $request)
    {
        //
        return new CoordinateResource(Coordinate::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $coordinate = Coordinate::find($id);
        return new CoordinateResource($coordinate);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(/*Request $request*/ UpdateCoordinateRequest $request, $id)
    {
        //
        $coordinate = Coordinate::find($id);
        $coordinate->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Coordinate::find($id)->delete();
    }
}
