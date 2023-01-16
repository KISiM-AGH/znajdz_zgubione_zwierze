<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Resources\V1\CommentPostResource;
use App\Http\Resources\V1\CommentPostCollection;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\V1\StoreCommentPostRequest;
use App\Http\Requests\V1\UpdateCommentPostRequest;
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
        return new CommentPostCollection(CommentPost::all());
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
    public function store(/*Request $request*/ StoreCommentPostRequest $request)
    {
        //
        return new CommentPostResource(CommentPost::create($request->all()));
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
        $commentPost = CommentPost::find($id);
        return new CommentPostResource($commentPost);
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
    public function update(/*Request $request, $id*/ UpdateCommentPostRequest $request, $id/*CommentPost $commentPost*/)
    {
        //
        $commentPost = CommentPost::find($id);
        $commentPost->update($request->all());
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
        CommentPost::find($id)->delete();
    }
}
