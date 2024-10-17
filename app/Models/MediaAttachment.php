<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaAttachment extends Model
{
    use HasFactory;
    protected $fillable = [
        'model_id',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
    ];

    
    public function attachable()
    {
        return $this->morphTo();
    }
}