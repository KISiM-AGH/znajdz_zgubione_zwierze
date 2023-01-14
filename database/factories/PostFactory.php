<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\MediaFile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    //private $faker = Faker\Factory::create('pl_PL');
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(14),
            'description' => fake()->text(50),
            'body' => fake()->text(1400),
            'is_ban' => 0,
            //'id_user' => factory(User::class)->create()->id,
            'id_user' => User::factory(),
            'id_media_file' => MediaFile::factory()->create()->id,
        ];
    }
}
