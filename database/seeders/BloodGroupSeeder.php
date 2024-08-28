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
            ['id' => 1 , 'blood_group'=> 'O+', 'created_at' => now()],
            ['id' => 2 , 'blood_group'=> 'A+', 'created_at' => now()],
            ['id' => 3 , 'blood_group'=> 'B+','created_at' => now()],
            ['id' => 4 , 'blood_group'=> 'AB+','created_at' => now()],
            ['id' => 5, 'blood_group'=> 'O-','created_at' => now()],
            ['id' => 6 , 'blood_group'=> 'A-','created_at' => now()],
            ['id' => 7 , 'blood_group'=> 'B-','created_at' => now()],
            ['id' => 8 , 'blood_group'=> 'AB-','created_at' => now()]
        ];
        
        DB::table('blood_groups')->insert($createUserType);
    }
}
