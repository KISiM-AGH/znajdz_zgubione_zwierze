<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\V1\StoreUserRequest;
use App\Http\Requests\V1\UpdateUserRequest;
use App\Http\Requests\V1\LoginUserRequest;
use App\Http\Resources\V1\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\V1\UserCollection;
use App\Filters\V1\UserFilter;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $authUser = Auth::user();
        $filter = new UserFilter();
        $queryItems = $filter->transform($request);// ['column' , 'operator', 'value']
        //dd($queryItems);
        if($authUser->tokenCan('user:show-all'))
        {
            if(count($queryItems) == 0)
            {
                return new UserCollection(User::paginate());
            }
            else
            {
                //dd(Announcement::where('id_user', 'like', 1)->get());
                //dd(Announcement::where($queryItems));
                $user = User::where($queryItems)->paginate();
                return new UserCollection($user->appends($request->query()));
            }
        }
        
        //return new UserCollection(User::all());
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
    public function store(/*Request $request*/ StoreUserRequest $request)
    {
        //
        return new UserResource(User::create([
            'name' => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "id_role" => $request->roleId,
            "location" => $request->location
        ]));
    }

    public function login(LoginUserRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials))
        {
            $seekerFinderPermission = [
                'announcement:store',
                'announcement:update-own',
                'announcement:destroy-own',
                'announcement:show-all',
                'announcement:show',
                'announcement:show-own',
                'media-file:store',
                'media-file:update-own',
                'media-file:destroy-own',
                'media-file:show-own',
                'comment-announcement:store',
                'comment-announcement:destroy-own',
                'comment-announcement:update-own',
                'comment-announcement:show-own',
                'comment-announcement:show',
                'comment-announcement:show-all',
                'comment-post:store',
                'comment-post:destroy-own',
                'comment-post:show-own',
                'comment-post:show',
                'comment-post:update-own',
                'comment-post:show-all',
                'coordinate:store',
                'coordinate:destroy-own',
                'coordinate:update-own',
                'coordinate:show-all',
                'coordinate:show',
                'post:store',
                'post:update-own',
                'post:destroy-own',
                'post:show-all',
                'post:show',
                'post:show-own',
                'chat:show-own',
                'chat:store',
                'chat:update-own',
                'chat:destroy-own',
                'message:show-own',
                'message:destroy-own',
                'message:update-own',
                'message:store',
                'userchat:show-own',
                'userchat:store',
                'userchat:update-own',
                'userchat:destroy-own',
                'user:update-own',
                'user:destroy-own',
                'user:show',
                'user:show-all'
            ];

            $moderatorPermission = [
                'announcement:update',
                'announcement:destroy',
                'comment-announcement:update',
                'comment-announcement:destroy',
                'comment-post:update',
                'post:update',
                'post:destroy',
                ...$seekerFinderPermission
            ];

            $administratorPermission = [
                'comment-announcement:destroy',
                'comment-post:destroy',
                'coordinate:show-all',
                'coordinate:update',
                'coordinate:destroy',
                'media-file:show-all',
                'media-file:destroy',
                'media-file:update',
                'comment-post:destroy',
                'chat:show-all',
                'chat:show',
                'chat:update',
                'chat:destroy',
                'message:show-all',
                'message:show',
                'message:destroy',
                'message:update',
                'userchat:show',
                'userchat:show-all',
                'userchat:update',
                'userchat:destroy',
                'user:destroy',
                'user:update',
                ...$moderatorPermission
            ];
            $user = Auth::user();

            switch($user->id_role)
            {
                case 1:
                    $token = $user->createToken('admin-token', $administratorPermission);
                break;
                case 2:
                    $token = $user->createToken('moderator-token', $moderatorPermission);
                break;
                case 3:
                    $token = $user->createToken('seekerfinder-token', $seekerFinderPermission);
                break;
            }

            return response()->json([
                'status' => 'success',
                'message' => "Login successfully",
                'tokenCode' => $token->plainTextToken
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 'failed',
                'message' => "Invalid credentials"
            ], 400);
        }
    }

    public function logout(Request $request)
    {
        if(Auth::check())
        {
            auth()->guard('api')->logout();
            foreach(Auth::user()->tokens as $token)
            {
                $token->delete();
            }
            return response()->json([
                'message' => "Logout successfully"
            ], 200);
        }
        else
        {
            return response()->json([
                'message' => "User is not log in"
            ], 406);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        $authUser = Auth::user();
        if($authUser->tokenCan('user:show'))
        {
            return new UserResource($user);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(/*Request $request*/ UpdateUserRequest $request, User $user)
    {
        //
        //$user = User::find($id);
        $authUser = Auth::user();
        if($authUser->tokenCan('user:update'))
        {
            $user->update($request->all());
            return new UserResource($user);
        }
        if($authUser->tokenCan('user:update-own'))
        {
            if($authUser->id == $user->id)
            {
                $user->update($request->all());
                return new UserResource($user);
            }
        }
        else
        {
            return response()->json([
                "message" => 'You have not permission'
            ], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $authUser = Auth::user();
        if($authUser->tokenCan('user:delete'))
        {
            $user->delete();
        }
        if($authUser->tokenCan('user:delete-own'))
        {
            if($authUser->id == $user->id)
            {
                $user->delete();
            }
        }
        else
        {
            return response()->json([
                "message" => 'You have not permission'
            ], 403);
        }
        
    }
}
