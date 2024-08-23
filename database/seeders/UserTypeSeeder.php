<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $createUserType = [
            ['id' => 1 , 'type'=>'Admin', 'created_at' => now()],
            ['id' => 2 , 'type'=>'Instructor', 'created_at' => now()],
            ['id' => 3 , 'type'=>'Learner','created_at' => now()]
        ];
        
        DB::table('user_types')->insert($createUserType);
    }
}
