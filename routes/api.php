<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', [App\Http\Controllers\Api\V1\UserController::class, 'login']);

Route::middleware('auth:sanctum')->post('logout', [App\Http\Controllers\Api\V1\UserController::class, 'logout']);

// Route::group(['namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => 'auth:api'], function() {
    
//     Route::post('logout', [/*App\Http\Controllers\Api\V1\*/UserController::class, 'logout']);
// });

//current name: api/v1
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => 'auth:sanctum'], function() {
    Route::apiResource('users', UserController::class);
    Route::apiResource('announcements', AnnouncementController::class);
    Route::apiResource('commentannouncements', CommentAnnouncementController::class);
    Route::apiResource('commentposts', CommentPostController::class);
    Route::apiResource('coordinates', CoordinateController::class);
    Route::apiResource('mediafiles', MediaFileController::class);
    Route::apiResource('messages', MessageController::class);
    Route::apiResource('posts', PostController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('typeannouncements', TypeAnnouncementController::class);
    Route::apiResource('userschats', UserChatController::class);
    Route::apiResource('chats', ChatController::class);
    Route::apiResource('userchats', UserChatController::class);
    
    
});
