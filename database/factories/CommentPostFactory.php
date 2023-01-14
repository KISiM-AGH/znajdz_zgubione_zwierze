<?php

namespace Database\Factories;

use App\Models\CommentPost;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommentPost>
 */
class CommentPostFactory extends Factory
{
    //private $faker = Faker\Factory::create('pl_PL');
    protected $model = CommentPost::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'content' => fake()->text(),
            'is_ban' => 0,
            //'id_user' => factory(User::class)->create()->id,
            'id_user' => User::factory(),
            //'id_post' => factory(Post::class)->create()->id
            'id_post' => Post::factory()
        ];
    }
}
