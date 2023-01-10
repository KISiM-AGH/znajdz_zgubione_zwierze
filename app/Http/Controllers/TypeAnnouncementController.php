<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTypeAnnouncementRequest;
use App\Http\Requests\UpdateTypeAnnouncementRequest;
use App\Models\TypeAnnouncement;

class TypeAnnouncementController extends Controller
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
     * @param  \App\Http\Requests\StoreTypeAnnouncementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeAnnouncementRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeAnnouncement  $typeAnnouncement
     * @return \Illuminate\Http\Response
     */
    public function show(TypeAnnouncement $typeAnnouncement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeAnnouncement  $typeAnnouncement
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeAnnouncement $typeAnnouncement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTypeAnnouncementRequest  $request
     * @param  \App\Models\TypeAnnouncement  $typeAnnouncement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeAnnouncementRequest $request, TypeAnnouncement $typeAnnouncement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeAnnouncement  $typeAnnouncement
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeAnnouncement $typeAnnouncement)
    {
        //
    }
}
