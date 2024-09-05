<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentPolicy extends Model
{
    use HasFactory;

    protected $table = 'privacy_policies';

    protected $fillable = [
        'title',
        'description'
    ];
}
