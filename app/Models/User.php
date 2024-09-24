<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
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
}
