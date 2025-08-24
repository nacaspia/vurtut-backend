<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = [
        'user_id',
        'company_id',
        'payment_type',
        'payment_status',
        'payment_amount',
        'payment_date',
        'payment_method',
        'payment_reference',
        'payment_description'
    ];
}
