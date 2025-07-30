<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    use HasFactory;

    protected $table = 'static_pages';

    protected $fillable = [
        'id', 'title','text','image','full_text','type','created_at','updated_at'
    ];

    protected $casts = [
        'title' => 'array',
        'text' => 'array',
        'full_text' => 'array',
    ];
}
