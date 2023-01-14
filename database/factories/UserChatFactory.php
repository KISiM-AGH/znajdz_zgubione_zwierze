<?php

namespace Database\Factories;

use App\Models\UserChat;
use App\Models\User;
use App\Models\Chat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserChat>
 */
class UserChatFactory extends Factory
{
    //private $faker = Faker\Factory::create('pl_PL');
    protected $model = UserChat::class;
    private int $repeatedIdChat;
    private int $currentIdUser;
    private int $olderIdUser;
    private array $arrNonEmptyChats; 
    public function configure()
    {
        return $this->afterCreating(function(UserChat $Chat) {
            $idsChat = Chat::All();
            $idsChat = $idsChat->toArray();
            $arrOfChatIds = [];
            $currentIdUser = $Chat->id_user;
            if(!isset($olderIdUser))
            {
                $olderIdUser = $currentIdUser;
                $arrNonEmptyChats = [];
            } 
            foreach($idsChat as $idChat)
            {
                array_push($arrOfChatIds, $idChat['id']);
            }
            if($currentIdUser == $olderIdUser)
            {
                $Chat->id_chat = fake()->randomElement($arrOfChatIds);
                array_push($arrNonEmptyChats, $Chat->id_chat);
                $Chat->save(); 
            } 
            else if($currentIdUser != $olderIdUser)
            {
                $Chat->id_chat = fake()->randomElement($arrNonEmptyChats);
            }
            //dd($idsChat->toArray());
           
            $Chat->id_chat = fake()->randomElement($arrOfChatIds);
            $Chat->save();
            $olderIdUser = $Chat->id_user;
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
            'id_user' => User::factory()
        ];
    }
}
