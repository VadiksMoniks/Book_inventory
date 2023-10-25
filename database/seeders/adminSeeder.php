<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'login' => 'root',
            'password' => '$2y$10$HLKvcYrpCug.q.BloHSvx.cc1mzw22OBT0odurI4Njucp6vuxmZre'
        ]);
    }
}
