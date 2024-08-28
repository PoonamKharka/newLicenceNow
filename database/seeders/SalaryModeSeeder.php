<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SalaryModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $createUserType = [
            ['id' => 1 , 'salary_mode'=> 'Direct Deposit ( EFT/NEFT )', 'created_at' => now()],
            ['id' => 2 , 'salary_mode'=> 'Cheque', 'created_at' => now()],
            ['id' => 3 , 'salary_mode'=> 'Cash','created_at' => now()],
            ['id' => 4 , 'salary_mode'=> 'Payroll Cards','created_at' => now()],
            ['id' => 5, 'salary_mode'=> 'Superannuation Contributions','created_at' => now()],
            ['id' => 6 , 'salary_mode'=> 'BPAY','created_at' => now()]
        ];
        
        DB::table('salary_pay_modes')->insert($createUserType);
    }
}
