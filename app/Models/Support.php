<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    protected $table = 'supports';

    protected $fillable = [
        'admin_id', 'obj_id', 'note', 'type', 'created_at'
    ];
}
