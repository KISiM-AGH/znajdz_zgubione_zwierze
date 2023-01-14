<?php

namespace Database\Factories;

use App\Models\MediaFile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MediaFile>
 */
class MediaFileFactory extends Factory
{
    //private $faker = Faker\Factory::create('pl_PL');
    protected $model = MediaFile::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $animal = '';
        $type = round(rand(0, 1));
        $animal = $type == 0 ? 'cats' : 'dogs';
        return [
            'name' => fake()->text(50),
            'type' => 'image/jpeg',
            //'url' => fake()->image(storage_path('app/public'), 640, 480, $animal, true, true),
            'url' => fake()->imageUrl(640, 480, $animal, true, true),
            'id_user' => User::factory()
        ];
    }
}
