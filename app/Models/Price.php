<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pricing';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['hours' , 'price'];

    public function lessonsPrice() {
        return $this->hasMany(LessonPrice::class, 'pricing_id');
    }

    public function instructors()
    {
        return $this->belongsToMany(User::class, 'instructor_prices', 'price_id', 'instructor_id')
            ->using(InstructorPrice::class)
            ->withPivot('id');
    }
}