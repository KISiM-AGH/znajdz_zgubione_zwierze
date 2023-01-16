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
        return new CommentAnnouncementCollection(CommentAnnouncement::all());
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
        return new CommentAnnouncementResource(CommentAnnouncement::create($request->all()));
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
        return new CommentAnnouncementResource($commentAnnouncement);
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
        $commentAnnouncement->update($request->all());
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
        CommentAnnouncement::find($id)->delete();
    }
}
