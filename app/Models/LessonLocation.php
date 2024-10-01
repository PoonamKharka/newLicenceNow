<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LessonLocation extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lesson_locations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['lesson_id' , 'location_id' ];

    public function lessons() {
        return $this->belongsTo(Lesson::class);
    }

    public function locations() {
        return $this->belongsTo(Location::class,'location_id');
    }
}
