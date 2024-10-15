<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'isAdmin',
        'userType_id',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the type associated with the user.
     */
    public function userType(): HasOne
    {
        return $this->hasOne(UserType::class, 'id', 'userType_id');
    }

    public function bankDetails()
    {
        return $this->hasOne(InstructorBankDetail::class, 'user_id', 'id');
    }

    // Define the relationship with ProfileDetails
    public function profileDetails()
    {
        return $this->hasOne(InstructorProfileDetail::class, 'user_id', 'id');
    }

    // Define the relationship with LearnerProfileDetails
    public function learnerProfileDetails()
    {
        return $this->hasOne(LearnerProfileDetails::class, 'user_id', 'id');
    }

    // Define the relationship with LearnerBankDetails
    public function learnerBankDetails()
    {
        return $this->hasOne(LearnerBankDetails::class, 'user_id', 'id');
    }

    public function instructorVehicle() {
        return $this->hasOne(InstructorVehicle::class, 'instructor_id', 'id');
    }
    
    /**
     * The locations associated with the user.
     */
    public function instructorLocations1()
    {
        //return $this->belongsToMany(Location::class, 'instructor_locations', 'instructor_id', 'location_id');

        return $this->belongsToMany(Location::class, 'instructor_locations', 'instructor_id', 'location_id')
        ->using(InstructorProfileDetail::class);

        // return $this->belongsToMany(Location::class, 'instructor_locations')
        // ->using(InstructorLocation::class) // Use the pivot model
        // ->withPivot('isAuto', 'isManual'); // Include any additional fields from the pivot


        //return $this->hasMany(InstructorLocation::class, 'instructor_id', 'id');
    }
    public function instructorLocations()
    {
        return $this->belongsToMany(Location::class, 'instructor_locations', 'instructor_id', 'location_id')
                    ->using(InstructorLocation::class)
                    ->withPivot('id');
    }

    // public function locations()
    // {
    //     return $this->belongsToMany(Location::class, 'instructor_locations')
    //                 ->using(InstructorLocation::class) // Pivot model
    //                 ->withPivot('id'); // Include pivot fields if needed
    // }
}