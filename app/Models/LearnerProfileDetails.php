<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearnerProfileDetails extends Model
{
    use HasFactory;

    protected $table = 'learner_profile_details';
    protected $primary_key = 'user_id';

    protected $fillable =
    [
        'user_id',
        'phoneNo',
        'dob',
        'age',
        'profile_picture',
        'corresponding_address',
        'course_start',
        'course_end',
        'blood_group_id',
        'gender_id'
    ];
}
