<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ChatResource;
use App\Http\Resources\V1\ChatCollection;

use App\Http\Requests\V1\StoreChatRequest;
use App\Http\Requests\V1\UpdateChatRequest;
use App\Models\Chat;
use App\Models\UserChat;
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
        $includeOwnChats = $request->query('ownChats');
        $userAuth = Auth::user();
        if($userAuth->tokenCan('chat:show-all'))
        {
            if($includeOwnChats)
            {
                $userChats = UserChat::where('id_user', 'LIKE', $userAuth->id)->get();
                $isFirst = true;
                foreach($userChats as $userChat )
                {
                    if($isFirst) 
                    {
                        if($includeChatMessages)
                        {
                            $firstChat = Chat::where([[$queryItems], ['id', 'LIKE', $userChat['id_chat']]])->with('messages')->get();
                        }
                        else
                        {
                            $firstChat = Chat::where([[$queryItems], ['id', 'LIKE', $userChat['id_chat']]])->get();
                        }
                        
                        $isFirst = false;
                    }
                    if($includeChatMessages)
                    {
                        $tmpChat = Chat::where([[$queryItems], ['id', 'LIKE', $userChat['id_chat']]])->with('messages')->get();
                    }
                    else
                    {
                        $tmpChat = Chat::where([[$queryItems], ['id', 'LIKE', $userChat['id_chat']]])->get();
                    }
                    
                    $firstChat = $firstChat->merge($tmpChat);
                    $chats = $firstChat->all();
                    
                }
                if($userChats->first())
                {
                    
                    $includeChatMessages = false;
                    $arrChat = [];
                    foreach($chats as $chat)
                    {
                        array_push($arrChat, [
                            "id" => $chat->id,
                            "name" => $chat->name,
                            "createdAt" => $chat->created_at,
                            "updatedAt" => $chat->updated_at,
                            "messages" => $chat->messages
                        ]);
                    }
                    return response()->json(["chats" => $arrChat], 200);
                }
                return response()->json(["message" => 'No content', 'chats' => []], 404);
            }
            else
            {
                $chats = Chat::where($queryItems);
            }
        }
        else if($userAuth->tokenCan('chat:show-own'))
        {
            $userChats = UserChat::where('id_user', 'LIKE', $userAuth->id)->get();
            $isFirst = true;
            foreach($userChats as $userChat )
            {
                if($isFirst)
                {
                    if($includeChatMessages)
                    {
                        $firstChat = Chat::where([[$queryItems], ['id', 'LIKE', $userChat['id_chat']]])->with('messages')->get();
                    }
                    else
                    {
                        $firstChat = Chat::where([[$queryItems], ['id', 'LIKE', $userChat['id_chat']]])->get();
                    }
                    
                    $isFirst = false;
                }
                if($includeChatMessages)
                {
                    $tmpChat = Chat::where([[$queryItems], ['id', 'LIKE', $userChat['id_chat']]])->with('messages')->get();
                }
                else
                {
                    $tmpChat = Chat::where([[$queryItems], ['id', 'LIKE', $userChat['id_chat']]])->get();
                }
                
                $firstChat = $firstChat->merge($tmpChat);
                $chats = $firstChat->all();
                
            }
            if($userChats->first())
            {
                
                $includeChatMessages = false;
                $arrChat = [];
                foreach($chats as $chat)
                {
                    array_push($arrChat, [
                        "id" => $chat->id,
                        "name" => $chat->name,
                        "createdAt" => $chat->created_at,
                        "updatedAt" => $chat->updated_at,
                        "messages" => $chat->messages
                    ]);
                }
                return response()->json(["chats" => $arrChat], 200);
            }
            return response()->json(["message" => 'No content', "chats" => []], 404);
        }
        else
        {
            return response->json(["message" => "No access"], 403);
        }
        if($includeChatMessages)
        {
            $chats = $chats->with('messages');
        }
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
        $userAuth = Auth::user();
        if($this->authorize('create', Chat::class))
        {
            $newChat = new ChatResource(Chat::create($request->all()));
            UserChat::create(['id_user' => $userAuth->id, 'id_chat' => $newChat->id]);
            return $newChat;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat, Request $request)
    {
        if($this->authorize('view', $chat))
        {
            $includeMessages = $request->query('includesMessages');
            if($includeMessages)
            {
                return new ChatResource($chat->loadMissing('messages'));
            }
            return new ChatResource($chat);
        }
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
        if($this->authorize('update', $chat))
        {
            $chat->update($request->all());
            return new ChatResource($chat);
        }
        
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
        if($this->authorize('delete', $chat))
        {
            $chat->delete();
        };
    }
}
