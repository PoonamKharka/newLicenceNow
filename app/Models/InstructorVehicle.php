<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorVehicle extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'instructor_vehicle';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['instructor_id','vehicle_name' , 'vehicle_no' , 'ancap_rating', 'vehicle_image'];
}
