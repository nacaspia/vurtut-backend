<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_at',
        'token',
        'company_id',
        'client'
    ];
}
