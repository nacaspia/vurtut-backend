<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLike extends Model
{
    use HasFactory;

    protected $table = 'user_likes';

    protected $fillable = ['user_id', 'item_id', 'item_type'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function companyItem() {
        return $this->hasOne(Company::class, 'id','item_id')->where('status', 1)->with('comments');
    }
    public function company() {
        return $this->hasMany(Company::class, 'id','item_id')->where('status', 1);
    }
}
