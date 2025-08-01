<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPost extends Model
{
    use HasFactory;
    protected $table = 'user_posts';
    protected $fillable = [
        'user_id',
        'image',
        'title',
        'reads',
        'like',
        'share',
        'status'
    ];
}
