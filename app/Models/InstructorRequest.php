<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name', 
        'last_name',
        'email',
        'phoneNo',
        'postcode',
        'status',
        'user_id'
    ];
    public function mediaAttachments()
    {
        return $this->hasMany(MediaAttachment::class, 'instructor_request_id');
    }
}