<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class PostController extends Controller
{
    public function show(Post $post, $slug)
    {
        return Inertia::render('Show', [
            'author_name' => $post->user->name,
            'post' => $post,
            'publication_date' => $post->publication_date_formated,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
}
