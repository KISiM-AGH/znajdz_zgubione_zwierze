<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $userAuth = Auth::user();
        $filter = new MessageFilter();
        $queryItems = $filter->transform($request);// ['column' , 'operator', 'value']
        $queryItems = $filter->transform($request);// ['column' , 'operator', 'value']
        $includeOwnMessages = $request->query('ownMessages');
        //dd($queryItems);
        if($userAuth->tokenCan('message:show-all'))
        {
                //return response()->json(["user" => $userAuth->tokenCan('announcement:show-all')]);
                if($includeOwnMessages)
                {
                    if(count($queryItems) == 0)
                    {
                        $messages = Message::where([['id_user', 'LIKE', $userAuth->id]])->paginate();
                        return new MessageCollection$messages);
                    }
                    else
                    {
                        //dd(Announcement::where('id_user', 'like', 1)->get());
                        //dd(Announcement::where($queryItems));
                        $messages = Message::where([$queryItems, ['id_user', 'LIKE', $userAuth->id]])->paginate();
                        return new MessageCollection($messages->appends($request->query()));
                    }
                }
                if(count($queryItems) == 0)
                {
                    return new MessageResource(Message::paginate());
                }
                else
                {
                        //dd(Announcement::where('id_user', 'like', 1)->get());
                        //dd(Announcement::where($queryItems));
                    $messages = Message::where($queryItems)->paginate();
                    return new MessageCollection($messages->appends($request->query()));
                }
            }
            else if($userAuth->tokenCan('media-file:show-own'))
            {
                if(count($queryItems) == 0)
                {
                    $messages = Message::where([['id_user', 'LIKE', $userAuth->id]])->paginate();
                    return new MessageCollection($messages);
                }
                else
                {
                    //dd(Announcement::where('id_user', 'like', 1)->get());
                    //dd(Announcement::where($queryItems));
                    $messages = Message::where([$queryItems, ['id_user', 'LIKE', $userAuth->id]])->paginate();
                    return new MessageCollection($mediaFile->appends($request->query()));
                }
            }
            else
            {
                return response()->json(["message" => "No access"], 403);
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
        if($this->authorize('create', Message::class))
        {
            return new MessageResource(Message::create($request->all()));
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
        $message = Message::find($id);
        if($this->authorize('view', $message))
        {
            return new MessageResource($message);
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
    public function update(/*Request $request*/ UpdateMessageRequest $request, $id)
    {
        //
        $message = Message::find($id);
        if($this->authorize('update', $message))
        {
            $message->update($request->all());
            return new MessageResource($message);
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
        $message = Message::find($id);
        if($this->authorize('delete', $message))
        {
            $message->delete();
        }
    }
}
