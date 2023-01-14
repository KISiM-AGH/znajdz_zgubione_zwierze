<?php

namespace Database\Factories;
use App\Models\CommentAnnouncement;
use App\Models\User;
use App\Models\Announcement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommentAnnouncement>
 */
class CommentAnnouncementFactory extends Factory
{
    //private $faker = Faker\Factory::create('pl_PL');
    protected $model = CommentAnnouncement::class;
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
            //'id_announcement' => factory(Announcement::class)->create()->id
            'id_announcement' => Announcement::factory()
        ];
    }
}
