<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorProfileDetail extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'instructor_profile_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'std_code',
        'phoneNo',
        'picture',
        'contact_address',
        'dob',
        'doj',
        'dot',
        'blood_group',
        'driving_experience',
        'gender_id',
    ];
    
}
