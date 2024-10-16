<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'street',
        'city',
        'state',
        'postcode',
        'latitude',
        'longitude'
    ];

    public function lessonsLocation1() {
        return $this->hasMany(LessonLocation::class, 'location_id');
    }
    /**
     * The instructors associated with the location.
     */
    public function instructors1()
    {
        //return $this->belongsToMany(User::class, 'instructor_locations');

       // return $this->belongsToMany(User::class, 'instructor_locations', 'location_id', 'instructor_id');
        
        return $this->belongsToMany(User::class, 'instructor_locations', 'location_id', 'instructor_id')
                ->using(InstructorLocation::class) // Pivot model
                ->withPivot('id'); // Include pivot fields if needed
   
    }
    public function instructors()
    {
        return $this->belongsToMany(User::class, 'instructor_locations', 'location_id', 'instructor_id')
                    //->using(InstructorLocation::class) // Specify the pivot model if needed
                    ->withPivot('id'); // Include any pivot fields if necessary
    }
}