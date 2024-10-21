<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaAttachment extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'media_attachments';
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'instructor_request_id',
        'file_name',
        'file_path',
        'file_type',
        'file_status',
    ];

    
    public function instructorRequest()
    {
        return $this->belongsTo(InstructorRequest::class);
    }
}