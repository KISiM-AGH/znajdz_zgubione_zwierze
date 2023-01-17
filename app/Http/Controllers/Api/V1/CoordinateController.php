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
use App\Models\Announcement;

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
        $userAuth = Auth::user();
        if($userAuth->tokenCan('coordinate:show-all'))
        {
            $chats = Coordinate::all();
        }
        else if($userAuth->tokenCan('coordinate:show-own'))
        {
            $userCoordinates = Announcement::where('id_user', 'LIKE', $userAuth->id)->get();
            $isFirst = true;
            foreach($userCoordinates as $userCoordinate)
            {
                if($isFirst)
                {
                    $firstCoordinate = Coordinate::where([['id', 'LIKE', $userCoordinate['id_coordinate']]])->get();    
                    $isFirst = false;
                }
                $tmpCoordinate = Coordinate::where([['id', 'LIKE', $userCoordinate['id_coordinate']]])->get();
                $firstCoordinate = $firstCoordiante->merge($tmpCoordinate);
                $coordinates = $firstCoordinate->all();
            }
            if($userCoordinates->first())
            {
                $arrCoordinates = [];
                foreach($coordinates as $coordinate)
                {
                    array_push($arrCoordinate, [
                        "id" => $coordinate->id,
                        "name" => $coordinate->name,
                        "createdAt" => $coordinate->created_at,
                        "updatedAt" => $coordinate->updated_at,
                        "messages" => $coordinate->messages
                    ]);
                }
                return response()->json(["chats" => $arrCoordinate], 200);
            }
            return response()->json(["message" => 'No content', "coordinates" => []], 404);
        }
        else
        {
            return response->json(["message" => "No access"], 403);
        }
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
        $userAuth = Auth::user();
        if($this->authorize('create', Coordinate::class))
        {
            return new CoordinateResource(Coordinate::create($request->all()));
        }
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
        if($this->authorize('view', $coordinate))
        {
            return new CoordinateResource($coordinate);
        }
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
        if($this->authorize('update', $coordinate))
        {
            $coordinate->update($request->all());
            return new CoordinateResource($coordinate);
        }
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
        $coordinate = Coordinate::find($id);
        if($this->authorize('delete'))
        {
            $coordinate->delete();
        }
    }
}
