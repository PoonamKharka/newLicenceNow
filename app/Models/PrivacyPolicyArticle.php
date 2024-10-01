<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyPolicyArticle extends Model
{
    use HasFactory;
    protected $table = 'privacy_policy_articles';

    protected $fillable = [
        'title',        
        'description'
    ];
}