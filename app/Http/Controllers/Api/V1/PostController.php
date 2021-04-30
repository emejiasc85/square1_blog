<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()
            ->search()
            ->order()
            ->paginateIf();

        return PostResource::collection($posts);
    }
    
    public function show(Post $post, $slug)
    {
        return new PostResource($post);
    }
}
