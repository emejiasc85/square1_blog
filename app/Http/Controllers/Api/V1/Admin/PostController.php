<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Resources\Admin\PostResource;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index()
    {
        $posts = auth()
            ->user()
            ->posts()
            ->search()
            ->order()
            ->paginateIf();

        return PostResource::collection($posts);
    }
    
    public function store(PostStoreRequest $request)
    {
        $request->merge(['publication_date' => Carbon::now()]);

        $post = auth()->user()->posts()->create($request->only([
            'title',
            'description',
            'publication_date'
        ]));

        return new PostResource($post);
    }
}
