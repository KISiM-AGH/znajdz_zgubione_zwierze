<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\V1\StorePostRequest;
use App\Http\Requests\V1\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
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
        $userAuth = Auth::user();
        $filter = new PostFilter();
        $queryItems = $filter->transform($request);// ['column' , 'operator', 'value']
        $includePostComments = $request->query('includesComments');
        $queryItems = $filter->transform($request);// ['column' , 'operator', 'value']
        $includeOwnPosts = $request->query('ownPosts');
        //dd($queryItems);
        if($userAuth->tokenCan('post:show-all'))
        {
                //return response()->json(["user" => $userAuth->tokenCan('announcement:show-all')]);
                if($includeOwnPosts)
                {
                    if(count($queryItems) == 0)
                    {
                        $posts = Post::where([['id_user', 'LIKE', $userAuth->id]]);
                        if($includePostComments)
                        {
                            $posts = $posts->with('commentPosts');
                        }
                        return new PostCollection($posts->paginate());
                    }
                    else
                    {
                        //dd(Announcement::where('id_user', 'like', 1)->get());
                        //dd(Announcement::where($queryItems));
                        $posts = Post::where([$queryItems, ['id_user', 'LIKE', $userAuth->id]]);
                        if($includePostComments)
                        {
                            $posts = $posts->with('commentPosts');
                        }
                        return new PostCollection($posts->paginate()->appends($request->query()));
                    }
                }
                if(count($queryItems) == 0)
                {
                    $posts = Post::paginate();
                    if($includePostComments)
                    {
                        $posts = $posts->with('commentPosts');
                    }
                    return new PostCollection($posts);
                }
                else
                {
                        //dd(Announcement::where('id_user', 'like', 1)->get());
                        //dd(Announcement::where($queryItems));
                    $posts = Post::where($queryItems);
                    if($includePostComments)
                    {
                        $posts = $posts->with('commentPosts');
                    }
                    return new PostCollection($posts->paginate()->appends($request->query()));
                }
            }
            else if($userAuth->tokenCan('post:show-own'))
            {
                if(count($queryItems) == 0)
                {
                    $posts = Post::where([['id_user', 'LIKE', $userAuth->id]]);
                    if($includePostComments)
                    {
                        $posts = $posts->with('commentPosts');
                    }
                    return new PostCollection($posts->paginate());
                }
                else
                {
                    //dd(Announcement::where('id_user', 'like', 1)->get());
                    //dd(Announcement::where($queryItems));
                    $posts = Post::where([$queryItems, ['id_user', 'LIKE', $userAuth->id]])->paginate();
                    if($includePostComments)
                    {
                        $posts = $posts->with('commentPosts');
                    }
                    return new PostCollection($posts->appends($request->query()));
                }
            }
            else
            {
                return response()->json(["message" => "No access"], 403);
            } 
        // $posts = Post::where($queryItems);
        // if($includePostComments)
        // {
        //     $posts = $posts->with('commentPosts');
        // }
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

        //return new PostCollection($posts->paginate()->appends($request->query()));
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
        if($this->authorize('create', Post::class))
        {
            return new PostResource(Post::create($request->all()));
        }
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
        if($this->authorize('view', $post))
        {
            $includePostComments = $request->query('includesComments'); 
            if($includePostComments)
            {
                //$announcement = $announcement->with('commentAnnouncements');
                return new PostResource($post->loadMissing('commentPosts'));
            }
            return new PostResource($post);
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
    public function update(/*Request $request*/ UpdatePostRequest $request, $id)
    {
        //
        $post = Post::find($id);
        if($this->authorize('update', $post))
        {
            $post->update($request->all());
            return new PostResource($post);
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
        $post = Post::find($id);
        if($this->authorize('delete', $post))
        {
            $post->delete();
        }
    }
}
