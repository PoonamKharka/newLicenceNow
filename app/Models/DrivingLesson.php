<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrivingLesson extends Model
{
    use HasFactory;

    protected $table = 'driving_lessons';

    protected $fillable = [
        'title',
        'image',
        'price',
        'description'
    ];
}
