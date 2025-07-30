<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    protected $fillable = [
        'user_id',
        'company_id',
        'date',
        'full_name',
        'phone',
        'place_count',
        'person_count',
        'text',
        'company_text',
        'status',
    ];
}
