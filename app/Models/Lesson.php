<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lessons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title' , 'description' , 'status'];

    public function lessonLocations() {
        return $this->hasMany(LessonLocation::class, 'lesson_id');
    }

    public function lessonPrice() {
        return $this->hasMany(LessonPrice::class, 'lesson_id');
    }

}
