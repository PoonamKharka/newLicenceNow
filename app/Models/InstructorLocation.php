<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class InstructorLocation extends Pivot
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'instructor_locations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['location_id' , 'instructor_id','postcode'];

     /**
     * The users associated with the instructor location.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    
}