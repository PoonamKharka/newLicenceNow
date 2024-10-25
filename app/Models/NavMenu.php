<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavMenu extends Model
{
    use HasFactory;
    protected $table = 'nav_menus';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'status'
    ];
    public static function slugIsExist($slug)
    {
        return static::where('slug', 'LIKE', "{$slug}%")
        ->pluck('slug');
    }
}