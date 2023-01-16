<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\V1\StorePostRequest;
use App\Http\Requests\V1\UpdatePostRequest;
use App\Models\Post;
use App\Http\Resources\V1\PostResource;
use App\Http\Resources\V1\PostCollection;
use App\Filters\V1\PostFilter;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $filter = new PostFilter();
        $queryItems = $filter->transform($request);// ['column' , 'operator', 'value']
        $includePostComments = $request->query('includesComments'); 
        $posts = Post::where($queryItems);
        if($includePostComments)
        {
            $posts = $posts->with('commentPosts');
        }
        //dd($queryItems);
        //if(count($queryItems) == 0)
        //{
         //   return new PostCollection(Post::paginate());
        //}
        //else
        //{
            //dd(Announcement::where('id_user', 'like', 1)->get());
            //dd(Announcement::where($queryItems));
         //   $post = Post::where($queryItems)->paginate();
         //   return new PostCollection($post->appends($request->query()));
        //}
        //return new PostCollection(Post::all());

        return new PostCollection($posts->paginate()->appends($request->query()));
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
    public function store(/*Request $request*/ StorePostRequest $request)
    {
        //
        return new PostResource(Post::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        //
        $post = Post::find($id);
        $includePostComments = $request->query('includesComments'); 
        if($includePostComments)
        {
            //$announcement = $announcement->with('commentAnnouncements');
            return new PostResource($post->loadMissing('commentPosts'));
        }
        return new PostResource($post);
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
    public function update(/*Request $request*/ UpdatePostRequest $request, $id)
    {
        //
        $post = Post::find($id);
        $post->update($request->all());
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
