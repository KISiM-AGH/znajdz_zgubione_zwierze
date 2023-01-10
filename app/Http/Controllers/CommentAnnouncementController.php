<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentAnnouncementRequest;
use App\Http\Requests\UpdateCommentAnnouncementRequest;
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
     * @param  \App\Http\Requests\StoreCommentAnnouncementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentAnnouncementRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommentAnnouncement  $commentAnnouncement
     * @return \Illuminate\Http\Response
     */
    public function show(CommentAnnouncement $commentAnnouncement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommentAnnouncement  $commentAnnouncement
     * @return \Illuminate\Http\Response
     */
    public function edit(CommentAnnouncement $commentAnnouncement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentAnnouncementRequest  $request
     * @param  \App\Models\CommentAnnouncement  $commentAnnouncement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentAnnouncementRequest $request, CommentAnnouncement $commentAnnouncement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommentAnnouncement  $commentAnnouncement
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommentAnnouncement $commentAnnouncement)
    {
        //
    }
}
