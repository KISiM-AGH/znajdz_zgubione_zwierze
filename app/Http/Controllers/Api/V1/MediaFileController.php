<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\V1\MediaFileResource;
use App\Http\Resources\V1\MediaFileCollection;

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
        $filter = new MediaFileFilter();
        $queryItems = $filter->transform($request);// ['column' , 'operator', 'value']
        //dd($queryItems);
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
        return new MediaFileResource(MediaFile::create($request->all()));
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
        return new MediaFileResource($mediaFile);
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
        $mediaFile->update($request->all());
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
    }
}
