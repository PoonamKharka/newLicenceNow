<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentPolicyArticle extends Model
{
    use HasFactory;
    protected $table = 'payment_policy_articles';

    protected $fillable = [
        'title',        
        'description'
    ];
}