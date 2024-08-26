<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $createUserType = [
            ['id' => 1 , 'name'=> 'Female', 'created_at' => now()],
            ['id' => 2 , 'name'=> 'Male', 'created_at' => now()],
            ['id' => 3 , 'name'=> 'Others','created_at' => now()]
        ];
        
        DB::table('genders')->insert($createUserType);
    }
}
