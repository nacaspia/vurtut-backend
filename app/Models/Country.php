<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';

    protected $fillable = [
        'id', 'name', 'status', 'created_at','updated_at'
    ];

    protected $casts = [
        'name' => 'array',
    ];
}
