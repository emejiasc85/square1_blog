<?php

namespace tests\Feature\Api\V1\Admin;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserPostTest extends TestCase{
    
    use RefreshDatabase;
    
    function test_list_user_posts()
    {
        $user = $this->signIn();

        $post = Post::factory()->create([
            'user_id' => $user->id
        ]);

        $harryPost = Post::factory()->create();

        $this->getJson('api/v1/admin/posts')
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
            ])
            ->assertJsonMissing([
                'data' => [
                    1 => [
                        'id'               => $harryPost->id,
                        'title'            => $harryPost->title,
                        'description'      => $harryPost->description,
                        'publication_date' => $harryPost->publication_date,
                    ]
                ]
            ]);
    }
    
    function test_search_user_posts()
    {
        $user = $this->signIn();

        $post = Post::factory()->create([
            'user_id' => $user
        ]);

        $parameters = [
            'search' => $post->title
        ];

        $this->call('GET','api/v1/admin/posts', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $post->id,
                    ]
                ]
            ]);
    }
    
    function test_order_user_posts_by_publication_date()
    {
        $user = $this->signIn();

        $oldPost = Post::factory()->create([
            'user_id' => $user->id
        ]);

        $lastPost = Post::factory()->create([
            'user_id' => $user->id
        ]);

        $parameters = [
            'order_col' => 'publication_date',
            'order'     => 'desc'
        ];

        $this->call('GET','api/v1/admin/posts', $parameters)
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
    
    function test_store_an_user_post()
    {$this->withoutExceptionHandling();
        $user = $this->signIn();

        $data = Post::factory()->make();

        $parameters = [
            'title'       => $data->title,
            'description' => $data->description,
        ];

        $this->postJson('api/v1/admin/posts', $parameters)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'title'       => $data->title,
                    'description' => $data->description,
                ]
            ]);

        $this->assertDatabaseHas('posts', [
            'title'       => $data->title,
            'description' => $data->description,
            'user_id'     => $user->id,
        ]);
    }
    
    function test_validate_before_store_an_user_post()
    {
        $this->signIn();

        $this->postJson('api/v1/admin/posts', [])
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'title'       => ['The title field is required.'],
                    'description' => ['The description field is required.'],
                ]
            ]);

    }

}