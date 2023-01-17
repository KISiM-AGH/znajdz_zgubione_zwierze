<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\V1\StoreUserChatRequest;
use App\Http\Requests\V1\UpdateUserChatRequest;
use App\Models\UserChat;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\V1\UserChatResource;
use App\Http\Resources\V1\UserChatCollection;

class UserChatController extends Controller
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
        if($userAuth->tokenCan('userchat:show-all'))
            {
                //return response()->json(["user" => $userAuth->tokenCan('announcement:show-all')]);
                $userChats = UserChat::all();
            }
            else if($userAuth->tokenCan('userchat:show-own'))
            {
                $userChats = UserChat::where([['id_user', 'LIKE', $userAuth->id]]);
            }
            else
            {
                return response()->json(["message" => "No access"], 403);
            }
            
        return  new  UserChatCollection($userChats->paginate());
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
    public function store(/*Request $request*/ StoreUserChatRequest $request)
    {
        //
        if($this->authorize('create', UserChat::class))
        {
            return new UserChatResource(UserChat::create($request->all()));
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
        $userChat = UserChat::find($id);
        if($this->authorize('view', $userChat))
        {
            return new UserChatResource($userChat);
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
    public function update(/*Request $request*/ UpdateUserChatRequest $request, $id)
    {
        //
        $userChat = UserChat::find($id);
        if($this->authorize('update', $userChat))
        {
            $userChat->update($request->all());
            return new UserChatResource($userChat);
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
        $userChat = UserChat::find($id);
        if($this->authorize('delete', $userChat))
        {
            $userChat->delete();
        }
            
    }
}
