<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /*extends Model
{
    use HasFactory;*/

    protected $table = 'users';

    protected $fillable = [
        'id',
        'lang',
        'image',
        'background_image',
        'country_id',
        'city_id',
        'sub_region_id',
        'full_name',
        'data',
        'gender',
        'bio',
        'email',
        'phone',
        'password',
        'status',
    ];

    protected $casts = [
        'text' => 'array',
        'gender' => 'array',
        'data' => 'array',
    ];


    public function userLikes()
    {
        return $this->hasMany(UserLike::class, 'user_id', 'id')->with('companyItem');
    }


    public function userPost()
    {
        return $this->hasMany(UserPost::class, 'user_id', 'id');
    }


    public function userComment()
    {
        return $this->hasMany(CompanyCommit::class, 'user_id', 'id');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function subRegion()
    {
        return $this->hasOne(City::class, 'id', 'sub_region_id');
    }

    public function mainCities()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function companyReservation()
    {
        return $this->hasMany(Reservation::class, 'user_id', 'id')->orderBy('date', 'DESC');
    }
}
