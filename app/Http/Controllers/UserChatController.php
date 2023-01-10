<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserChatRequest;
use App\Http\Requests\UpdateUserChatRequest;
use App\Models\UserChat;

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
     * @param  \App\Http\Requests\StoreUserChatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserChatRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserChat  $userChat
     * @return \Illuminate\Http\Response
     */
    public function show(UserChat $userChat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserChat  $userChat
     * @return \Illuminate\Http\Response
     */
    public function edit(UserChat $userChat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserChatRequest  $request
     * @param  \App\Models\UserChat  $userChat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserChatRequest $request, UserChat $userChat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserChat  $userChat
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserChat $userChat)
    {
        //
    }
}
