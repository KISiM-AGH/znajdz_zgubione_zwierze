<?php

namespace Database\Factories;

use App\Models\Coordinate;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coordinate>
 */
class CoordinateFactory extends Factory
{
    //private $faker = Faker\Factory::create('pl_PL');
    protected $model = Coordinate::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'latitude' => fake()->latitude(45.0, 55.5),
            'longitude' => fake()->longitude(14.4, 25.3)
        ];
    }
}
