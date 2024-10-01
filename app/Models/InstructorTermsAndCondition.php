<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorTermsAndCondition extends Model
{
    use HasFactory;
    protected $table = 'instructor_terms_and_conditions';

    protected $fillable = [
        'title',        
        'description'
    ];
}