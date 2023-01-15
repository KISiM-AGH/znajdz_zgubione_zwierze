<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ChatResource;
use App\Http\Resources\V1\ChatCollection;

use App\Http\Requests\V1\StoreChatRequest;
use App\Http\Requests\UpdateChatRequest;
use App\Models\Chat;
use App\Filters\V1\ChatFilter;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $filter = new ChatFilter();
        $queryItems = $filter->transform($request);// ['column' , 'operator', 'value']
        $includeChatMessages = $request->query('includesMessages'); 
        $chats = Chat::where($queryItems);
        if($includeChatMessages)
        {
            $chats = $chats->with('messages');
        }
        //dd($queryItems);
        // if(count($queryItems) == 0)
        // {
        //     return new ChatCollection(Chat::paginate());
        // }
        // else
        // {
        //     //dd(Announcement::where('id_user', 'like', 1)->get());
        //     //dd(Announcement::where($queryItems));
        //     $chat = Chat::where($queryItems)->paginate();
        //     return new ChatCollection($chat->appends($request->query()));
        // }
        return new ChatCollection($chats->paginate()->appends($request->query()));
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
     * @param  \App\Http\Requests\StoreChatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChatRequest $request)
    {
        //
        return new ChatResource(Chat::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat, Request $request)
    {
        //
        $includeMessages = $request->query('includesMessages'); 
        if($includeMessages)
        {
            //$announcement = $announcement->with('commentAnnouncements');
            return new ChatResource($chat->loadMissing('messages'));
        }
        return new ChatResource($chat);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChatRequest  $request
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChatRequest $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
