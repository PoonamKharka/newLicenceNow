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
    protected $primaryKey = 'user_id';

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
        'blood_group_id',
        'driving_expirence',
        'gender_id'
    ];

    // Define the inverse relationship
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id', 'id');
    // }
    
}
