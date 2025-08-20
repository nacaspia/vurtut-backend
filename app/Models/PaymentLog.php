<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    use HasFactory;
    protected $table = 'payment_logs';
    protected $fillable = [
        'company_id',
        'user_id',
        'payment_id',
        'request',
        'response',
        'status',
        'message'
    ];
}
