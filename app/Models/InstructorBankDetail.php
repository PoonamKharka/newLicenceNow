<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorBankDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'salary_pay_mode',
        'salary_bank_name',
        'salary_branch_name',
        'salary_ifsc_code',
        'salary_account_number',
    ];
}
