<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPerson extends Model
{
    use HasFactory;

    protected $table = 'company_persons';

    protected $fillable = [
        'company_id',
        'name',
        'text',
        'image',
        'status',
    ];
}
