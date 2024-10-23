<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statesList = [
            ['id' => 1 , 'name'=> 'Australian Capital Territory', 'slug' =>  'ACT',  'created_at' => now()],
            ['id' => 2 , 'name'=> 'New South Wales', 'slug' => 'NSW' , 'created_at' => now()],
            ['id' => 3 , 'name'=> 'Northern Territory', 'slug' => 'NT' , 'created_at' => now()],
            ['id' => 4 , 'name'=> 'Queensland','slug' => 'QLD' , 'created_at' => now()],
            ['id' => 5, 'name'=> 'South Australia','slug' =>  'SA','created_at' => now()],
            ['id' => 6 , 'name'=> 'Tasmania','slug' => 'TAS' ,'created_at' => now()],
            ['id' => 7 , 'name'=> 'Victoria','slug' => 'VIC' ,'created_at' => now()],
            ['id' => 8 , 'name'=> 'Western Australia','slug' => 'WA' ,'created_at' => now()]
        ];
        
        DB::table('states')->insert($statesList);
    }
}
