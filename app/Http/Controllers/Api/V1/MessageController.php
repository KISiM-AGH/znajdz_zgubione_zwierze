<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\V1\StoreMessageRequest;
use App\Http\Requests\V1\UpdateMessageRequest;
use App\Models\Message;
use App\Http\Resources\V1\MessageResource;
use App\Http\Resources\V1\MessageCollection;
use App\Filters\V1\MessageFilter;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $filter = new MessageFilter();
        $queryItems = $filter->transform($request);// ['column' , 'operator', 'value']
        //dd($queryItems);
        if(count($queryItems) == 0)
        {
            return new MessageCollection(Chat::paginate());
        }
        else
        {
            //dd(Announcement::where('id_user', 'like', 1)->get());
            //dd(Announcement::where($queryItems));
            $message = Message::where($queryItems)->paginate();
            return new MessageCollection($message->appends($request->query()));
        }
        //return new MessageCollection(Message::all());
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
    public function store(/*Request $request*/ StoreMessageRequest $request)
    {
        //
        return new MessageResource(Message::create($request->all()));
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
        $message = Message::find($id);
        return new MessageResource($message);
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
    public function update(/*Request $request*/ UpdateMessageRequest $request, $id)
    {
        //
        $message = Message::find($id);
        $message->update($request->all());
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
    }
}
