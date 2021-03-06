<?php


use App\Http\Controllers\Api\V1\Admin\PostController;
use App\Http\Controllers\Api\V1\PostController as PublicPostController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function(){

    Route::namespace('V1')->prefix('v1')->group(function(){
        
        Route::get('posts', [PublicPostController::class, 'index']);
        Route::get('posts/{post}', [PublicPostController::class, 'show']);

        Route::namespace('Admin')->prefix('admin')->middleware('auth:api')->group(function(){
            Route::get('posts', [PostController::class, 'index']);
            Route::post('posts', [PostController::class, 'store']);
        });
        
    });
});
