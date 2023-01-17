<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Resources\V1\CommentAnnouncementResource;
use App\Http\Resources\V1\CommentAnnouncementCollection;

use App\Http\Requests\V1\StoreCommentAnnouncementRequest;
use App\Http\Requests\V1\UpdateCommentAnnouncementRequest;
use App\Models\CommentAnnouncement;

class CommentAnnouncementController extends Controller
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
        if($userAuth->tokenCan('comment-announcement:show-all'))
        {
             //return response()->json(["user" => $userAuth->tokenCan('announcement:show-all')]);
             $commentAnnouncements = CommentAnnouncement::all();
        }
        else if($userAuth->tokenCan('comment-announcement:show-own'))
        {
            $commentAnnouncements = CommentAnnouncement::where(['id_user', 'LIKE', $userAuth->id]);
        }
        else
        {
            return response()->json(["message" => "No access"], 403);
        }
        //return response()->json(["message" => $commentAnnouncements->paginate()], 200);
        return new CommentAnnouncementCollection($commentAnnouncements);
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
    public function store(/*Request $request*/ StoreCommentAnnouncementRequest $request)
    {
        //
        if($this->authorize('create', CommentAnnouncement::class))
        {
            return new CommentAnnouncementResource(CommentAnnouncement::create($request->all()));
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
        $commentAnnouncement = CommentAnnouncement::find($id);
        if($this->authorize('view', $commentAnnouncement))
        {
            return new CommentAnnouncementResource($commentAnnouncement);
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
    public function update(/*Request $request*/ UpdateCommentAnnouncementRequest $request, $id)
    {
        //
        $commentAnnouncement = CommentAnnouncement::find($id);
        if($this->authorize('update', $commentAnnouncement))
        {
            $commentAnnouncement->update($request->all());
            return new commentAnnouncementResource($commentAnnouncement);
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
        $commentAnnouncement = CommentAnnouncement::find($id);
        if($this->authorize('delete', $commentAnnouncement))
        {
            $commentAnnouncement->delete();
        };
        
    }
}
