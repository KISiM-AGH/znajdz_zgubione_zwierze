<?php

namespace Database\Factories;

use App\Models\TypeAnnouncement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TypeAnnouncement>
 */
class TypeAnnouncementFactory extends Factory
{
    //private $faker = Faker\Factory::create('pl_PL');
    protected $model = TypeAnnouncement::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        //$type = round(rand(0, 1));
        $name = fake()->randomElement(['finding', 'disappearance']);
        //unnecessary
        return [
            'name' => $name
        ];
    }
}
