<?php

namespace Tests\Feature\Api\V1;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase{
    
    use RefreshDatabase;
    
    function test_list_posts()
    {
        $post = Post::factory()->create();

        $this->getJson('api/v1/posts')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id'               => $post->id,
                        'title'            => $post->title,
                        'description'      => $post->description,
                        'publication_date' => $post->publication_date,
                    ]
                ]
            ]);
    }
    
    function test_search_posts()
    {
        
        $post = Post::factory()->create();

        $parameters = [
            'search' => $post->title
        ];

        $this->call('GET','api/v1/posts', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $post->id,
                    ]
                ]
            ]);
    }
    
    function test_order_posts_by_publication_date()
    {

        $oldPost = Post::factory()->create();

        $lastPost = Post::factory()->create();

        $parameters = [
            'order_col' => 'publication_date',
            'order'     => 'desc'
        ];

        $this->call('GET','api/v1/posts', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $oldPost->id,
                    ],
                    1 => [
                        'id' => $lastPost->id,
                    ]
                ]
            ]);
    }
    
    function test_show_post()
    {

        $post = Post::factory()->create();

        $this->getJson('api/v1/posts/'.$post->id.'/'.$post->slug)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id'               => $post->id,
                    'title'            => $post->title,
                    'description'      => $post->description,
                    'publication_date' => $post->publication_date,
                ]
            ]);
    }
    
    

}