<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';

    protected $fillable = [
        'id','obj_id','subj_id','subj_table','action','note','ip_address'
    ];

    public function objUser(){
        return $this->hasOne(User::class,'id','obj_id');
    }

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function objCompany(){
        return $this->hasOne(Company::class,'id','obj_id');
    }
    public function company(){
        return $this->hasOne(Company::class,'id','company_id');
    }
}
