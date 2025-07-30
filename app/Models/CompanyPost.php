<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPost extends Model
{
    use HasFactory;

    protected $table = 'company_posts';
    protected $fillable = [
        'company_id',
        'image',
        'title',
        'reads',
        'like',
        'share',
        'status'
    ];
}
