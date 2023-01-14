<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Administrator',
            'description' => 'System Managment include user and their resources'
        ]);

        DB::table('roles')->insert([
            'name' => 'Moderator',
            'description' => 'Posts & announcements managment. Is able to ban insulting announcement or post.'
        ]);

        DB::table('roles')->insert([
            'name' => 'SeekerFinder',
            'description' => 'Can chatting, posting, commenting, uploading files, announce diseapperings and findings'
        ]);
    }
}
