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

    
    /**
     * The instructors associated with the location.
     */
    
    public function instructors()
    {
        return $this->belongsToMany(User::class, 'instructor_locations', 'location_id', 'instructor_id')
                    //->using(InstructorLocation::class) 
                    ->withPivot('id'); 
    }
}