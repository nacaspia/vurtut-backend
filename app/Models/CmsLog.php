<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsLog extends Model
{
    use HasFactory;
    protected $table = 'cms_logs';


    protected $fillable = [
        'id','cms_user_id','subj_id','subj_table','action','note','created_at'
    ];

    protected $casts = [
        'note' => 'array',
    ];
}
