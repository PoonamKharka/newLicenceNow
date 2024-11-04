<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestPackage extends Model
{
    use HasFactory;

    protected $table = 'test_packages';

    protected $fillable = [
        'title',
        'image',
        'img_path',
        'price',
        'listing',
        'disclaimer',
    ];
}