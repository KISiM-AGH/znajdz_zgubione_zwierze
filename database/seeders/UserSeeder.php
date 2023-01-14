<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Announcement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(10)
            ->hasAnnouncements(4)
            ->hasCommentAnnouncements(2)
            ->hasPosts(5)
            ->hasCommentPosts(2)
            ->hasMediaFiles(3)
            ->hasUserChats(4)
            ->hasMessages(30)
            ->create();
    }
}
