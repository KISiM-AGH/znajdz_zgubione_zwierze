<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\User;
use App\Models\Chat;
use App\Models\UserChat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    //private $faker = Faker\Factory::create('pl_PL');
    protected $model = Message::class;

    public function configure()
    {
        return $this->afterCreating(function(Message $Message) {
            $idsChat = UserChat::where('id_user', $Message->id_user)->get();
            //dd($idsChat->toArray());
            $idsChat = $idsChat->toArray();
            $arrOfChatIds = [];
            foreach($idsChat as $idChat)
            {
                array_push($arrOfChatIds, $idChat['id_chat']);
            }
            $Message->id_chat = fake()->randomElement($arrOfChatIds);
            $Message->save();
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'content' => fake()->text(100),
            //'id_chat' => factory(Chat::class)->create()->id,
            
            //'id_user' => factory(User::class)->create()->id
            'id_user' => User::factory()
        ];
    }
}
