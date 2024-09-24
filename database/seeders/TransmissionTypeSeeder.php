<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransmissionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $createUserType = [
            ['id' => 1 , 'title'=> 'Both', 'created_at' => now()],
            ['id' => 2 , 'title'=> 'Automatic', 'created_at' => now()],
            ['id' => 3 , 'title'=> 'Manual','created_at' => now()]
        ];
        
        DB::table('transmission_types')->insert($createUserType);
    }
}
