<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyCommit extends Model
{
    use HasFactory;

    protected $table = 'company_commits';

    protected $fillable = [
        'company_id',
        'user_id',
        'committer_id',
        'committer_user_id',
        'comment',
        'image_comment',
        'cleanliness',
        'comfort',
        'staf',
        'facilities',
        'reads',
        'like',
        'share',
        'date',
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function users(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function committer(){
        return $this->hasMany(CompanyCommit::class,'committer_id','id')->with('company','users');
    }
}
