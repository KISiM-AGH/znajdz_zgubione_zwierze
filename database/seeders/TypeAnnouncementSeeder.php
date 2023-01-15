<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TypeAnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_announcements')->insert([
            'name' => 'finder'
        ]);

        DB::table('type_announcements')->insert([
            'name' => 'seeker'
        ]);
    }
}
