<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AnnouncementResource;
use App\Http\Resources\V1\AnnouncementCollection;
use Illuminate\Http\Request;
use App\Http\Requests\V1\StoreAnnouncementRequest;
use App\Http\Requests\V1\UpdateAnnouncementRequest;
use App\Models\Announcement;
use App\Filters\V1\AnnouncementFilter;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $filter = new AnnouncementFilter();
        $queryItems = $filter->transform($request);// ['column' , 'operator', 'value']
        $includeAnnouncementComments = $request->query('includesComments');
        $userAuth = Auth::user();

        //return response()->json(["user" => $userAuth->id, "ann" => Announcement::where('id_user', 'LIKE' ,$userAuth->id)->get()]);
        //dd($res);
            if($userAuth->tokenCan('announcement:show-all'))
            {
                //return response()->json(["user" => $userAuth->tokenCan('announcement:show-all')]);
                $announcements = Announcement::where($queryItems);
            }
            else if($userAuth->tokenCan('announcement:show-own'))
            {
                $announcements = Announcement::where([[$queryItems], ['id_user', 'LIKE', $userAuth->id]]);
            }
            else
            {
                return response()->json(["message" => "No access"], 403);
            }
            
            if($includeAnnouncementComments)
            {
                $announcements = $announcements->with('commentAnnouncements');
            }
            return new AnnouncementCollection($announcements->paginate()->appends($request->query()));
       

        //dd($queryItems);
        //if(count($queryItems) == 0)
        //{
         //   return new AnnouncementCollection(Announcement::paginate());
        //}
        //else
        //{
            //dd(Announcement::where('id_user', 'like', 1)->get());
            //dd(Announcement::where($queryItems));
       
         //   return new AnnouncementCollection($announcement->appends($request->query()));
        //}
        
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
     * @param  \App\Http\Requests\StoreAnnouncementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAnnouncementRequest $request)
    {
        //
        if($this->authorize('create', Announcement::class))
        {
            return new AnnouncementResource(Announcement::create($request->all()));
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement, Request $request)
    {
        //
        //return $announcement;
        if($this->authorize('view', $announcement))
        {
            $includeAnnouncementComments = $request->query('includesComments');
            if($includeAnnouncementComments)
            {
                //$announcement = $announcement->with('commentAnnouncements');
                return new AnnouncementResource($announcement->loadMissing('commentAnnouncements'));
            }
            return new AnnouncementResource($announcement);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAnnouncementRequest  $request
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAnnouncementRequest $request, Announcement $announcement)
    {
        //
        if($this->authorize('update', $announcement))
        {
            $announcement->update($request->all());
            return new AnnouncementResource($announcement);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
        //
        if($this->authorize('delete', $announcement))
        {
            $announcement->delete();
        };
    }
}
