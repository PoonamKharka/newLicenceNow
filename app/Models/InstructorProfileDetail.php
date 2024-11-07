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
        'profile_picture',
        'contact_address',
        'date_of_birth',
        'date_of_joining',
        'date_of_termination',
        'blood_group_id',
        'driving_expirence',
        'gender_id',
        'languages',
        'isAuto',
        'isManual'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function instructors()
    {
        return $this->hasMany(User::class, 'user_id');
    }

    public function locations(){
        return $this->hasMany(InstructorLocation::class, 'instructor_id', 'user_id');
    }

    public function prices(){
        return $this->hasMany(InstructorPrice::class, 'instructor_id', 'user_id');
    }
    
}