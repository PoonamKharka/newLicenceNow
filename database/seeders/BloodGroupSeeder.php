<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BloodGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $createUserType = [
            ['id' => 1 , 'name'=> 'O+', 'created_at' => now()],
            ['id' => 2 , 'name'=> 'A+', 'created_at' => now()],
            ['id' => 3 , 'name'=> 'B+','created_at' => now()],
            ['id' => 4 , 'name'=> 'AB+','created_at' => now()],
            ['id' => 5, 'name'=> 'O-','created_at' => now()],
            ['id' => 6 , 'name'=> 'A-','created_at' => now()],
            ['id' => 7 , 'name'=> 'B-','created_at' => now()],
            ['id' => 8 , 'name'=> 'AB-','created_at' => now()]
        ];
        
        DB::table('blood_group')->insert($createUserType);
    }
}
