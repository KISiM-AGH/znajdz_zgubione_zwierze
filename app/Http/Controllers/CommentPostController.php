<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentPostRequest;
use App\Http\Requests\UpdateCommentPostRequest;
use App\Models\CommentPost;

class CommentPostController extends Controller
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
     * @param  \App\Http\Requests\StoreCommentPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentPostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommentPost  $commentPost
     * @return \Illuminate\Http\Response
     */
    public function show(CommentPost $commentPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommentPost  $commentPost
     * @return \Illuminate\Http\Response
     */
    public function edit(CommentPost $commentPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentPostRequest  $request
     * @param  \App\Models\CommentPost  $commentPost
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentPostRequest $request, CommentPost $commentPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommentPost  $commentPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommentPost $commentPost)
    {
        //
    }
}
