<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstructorBankDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'instructor_bank_details';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'salary_pay_mode_id',
        'salary_bank_name',
        'salary_branch_name',
        'salary_ifsc_code',
        'salary_account_number',
         'state',
        'postal_code'
    ];

    // Define the inverse relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
