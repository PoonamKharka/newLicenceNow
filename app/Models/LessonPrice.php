<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonPrice extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lesson_prices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['lesson_id' , 'pricing_id' ];

    public function lessons() {
        return $this->belongsTo(Lesson::class);
    }

    public function prices() {
        return $this->belongsTo(Price::class,'pricing_id');
    }
}
