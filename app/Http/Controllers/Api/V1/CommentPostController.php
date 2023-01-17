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
        $userAuth = Auth::user();

        //return response()->json(["user" => $userAuth->id, "ann" => Announcement::where('id_user', 'LIKE' ,$userAuth->id)->get()]);
        //dd($res);
        if($userAuth->tokenCan('comment-post:show-all'))
        {
             //return response()->json(["user" => $userAuth->tokenCan('announcement:show-all')]);
             $commentPosts = CommentPost::all();
        }
        else if($userAuth->tokenCan('comment-post:show-own'))
        {
            $commentPosts = CommentPost::where([ ['id_user', 'LIKE', $userAuth->id]]);
        }
        else
        {
            return response()->json(["message" => "No access"], 403);
        }
        //return new CommentAnnouncementCollection(CommentAnnouncement::all());
        return new CommentPostCollection($commentPosts);
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
        if($this->authorize('create', CommentPost::class))
        {
            return new CommentPostResource(CommentPost::create($request->all()));
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
        $commentPost = CommentPost::find($id);
        if($this->authorize('view', $commentPost))
        {
            return new CommentPostResource($commentPost);
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
    public function update(/*Request $request, $id*/ UpdateCommentPostRequest $request, $id/*CommentPost $commentPost*/)
    {
        //
        $commentPost = CommentPost::find($id);
        if($this->authorize('update', $commentPost))
        {
            $commentPost->update($request->all());
            return new CommentPostResource($commentPost);
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
        $commentAnnouncement = CommentPost::find($id);
        if($this->authorize('delete', $commentAnnouncement))
        {
            $commentAnnouncement->delete();
        }
    }
}
