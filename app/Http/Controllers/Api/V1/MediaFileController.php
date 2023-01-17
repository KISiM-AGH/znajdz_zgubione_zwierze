<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\V1\MediaFileResource;
use App\Http\Resources\V1\MediaFileCollection;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\V1\StoreMediaFileRequest;
use App\Http\Requests\V1\UpdateMediaFileRequest;
use App\Models\MediaFile;
use App\Filters\V1\MediaFileFilter;

class MediaFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $userAuth = Auth::user();
        $filter = new MediaFileFilter();
        $queryItems = $filter->transform($request);// ['column' , 'operator', 'value']
        $includeOwnMediaFiles = $request->query('ownMediaFiles');
        //dd($queryItems);
        if($userAuth->tokenCan('media-file:show-all'))
        {
                //return response()->json(["user" => $userAuth->tokenCan('announcement:show-all')]);
                if($includeOwnMediaFiles)
                {
                    if(count($queryItems) == 0)
                    {
                        $mediaFile = MediaFile::where([['id_user', 'LIKE', $userAuth->id]])->paginate();
                        return new MediaFileCollection($mediaFile);
                    }
                    else
                    {
                        //dd(Announcement::where('id_user', 'like', 1)->get());
                        //dd(Announcement::where($queryItems));
                        $mediaFile = MediaFile::where([$queryItems, ['id_user', 'LIKE', $userAuth->id]])->paginate();
                        return new MediaFileCollection($mediaFile->appends($request->query()));
                    }
                }
                if(count($queryItems) == 0)
                {
                    return new MediaFileCollection(MediaFile::paginate());
                }
                else
                {
                        //dd(Announcement::where('id_user', 'like', 1)->get());
                        //dd(Announcement::where($queryItems));
                    $mediaFile = MediaFile::where($queryItems)->paginate();
                    return new MediaFileCollection($mediaFile->appends($request->query()));
                }
            }
            else if($userAuth->tokenCan('media-file:show-own'))
            {
                if(count($queryItems) == 0)
                {
                    $mediaFile = MediaFile::where([['id_user', 'LIKE', $userAuth->id]])->paginate();
                    return new MediaFileCollection($mediaFile);
                }
                else
                {
                    //dd(Announcement::where('id_user', 'like', 1)->get());
                    //dd(Announcement::where($queryItems));
                    $mediaFile = MediaFile::where([$queryItems, ['id_user', 'LIKE', $userAuth->id]])->paginate();
                    return new MediaFileCollection($mediaFile->appends($request->query()));
                }
            }
            else
            {
                return response()->json(["message" => "No access"], 403);
            }
 
        //return new MediaFileCollection(MediaFile::all()); 
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
    public function store(/*Request $request*/ StoreMediaFileRequest $request)
    {
        //
        if($this->authorize('create', MediaFile::class))
        {
            return new MediaFileResource(MediaFile::create($request->all()));
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
        $mediaFile = MediaFile::find($id);
        if($this->authorize('view', $mediaFile))
        {
            return new MediaFileResource($mediaFile);
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
    public function update(/*Request $request*/ UpdateMediaFileRequest $request, $id)
    {
        //
        $mediaFile = MediaFile::find($id);
        if($this->authorize('update', $mediaFile))
        {
            $mediaFile->update($request->all());
            return new MediaFileResource($mediaFile);
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
        $mediaFile = MediaFile::find($id);
        if($this->authorize('delete', $mediaFile))
        {
            $mediaFile->delete();
        }
        
    }
}
