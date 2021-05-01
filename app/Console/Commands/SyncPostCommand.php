<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SyncPostCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sync post from another blogging platform';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $url = 'https://sq1-api-test.herokuapp.com/posts';

        $response = Http::get($url);

        $posts = json_decode($response->body());

        foreach ($posts->data as $post) {

            Post::updateOrCreate([
                'user_id' => 1, 
                'title' => $post->title,
                'publication_date' => $post->publication_date
            ],[
                'description' => $post->description
            ]);

        }

        return 0;
    }
}
