<?php

namespace Database\Factories;

use App\Models\Announcement;
use App\Models\MediaFile;
use App\Models\User;
use App\Models\Coordinate;
use App\Models\TypeAnnouncement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
     //private $faker = Faker\Factory::create('pl_PL');
     protected $model = Announcement::class;
    
     /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(7),
            'localization' => fake()->city(),
            'description' => fake()->text(),
            'id_media_file' => MediaFile::factory()->create()->id,
            //'id_user' => factory(User::class)->create()->id,
            'id_user' => User::factory(),
            'id_coordinate' => Coordinate::factory()->create()->id,
            'id_type_announcement' => round(rand(1, 2))
        ];
    }
}
