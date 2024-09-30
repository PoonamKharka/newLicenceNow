<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearnerTermsAndCondition extends Model
{
    use HasFactory;
    protected $table = 'learner_terms_and_conditions';

    protected $fillable = [
        'title',        
        'description'
    ];
}