<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'            => $this->faker->title,
            'slug'             => Str::slug($this->faker->title),
            'description'      => $this->faker->paragraph(3),
            'publication_date' => Carbon::now(),
            'user_id'          => User::factory()->create()->id 
        ];
    }
}
