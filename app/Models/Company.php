<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Company extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'companies';

    protected $fillable = [
        'id',
        'category_id',
        'parent_id',
        'service_type',
        'country_id',
        'city_id',
        'sub_region_id',
        'lang',
        'image',
        'background_image',
        'full_name',
        'slug',
        'text',
        'email',
        'phone',
        'password',
        'status',
        'is_premium',
        'is_paid',
        'type',
        'data',
        'social',
        'service_type',
        'share',
        'time'
    ];

    protected $casts = [
        'data' => 'array',
        'social' => 'array',
        'service_type' => 'array',
        'time' => 'array',
    ];

    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function parent(){
        return $this->hasMany(Company::class,'parent_id','id')->whereNotNull('parent_id');
    }

    public function country(){
        return $this->hasOne(Country::class,'id','country_id');
    }

    public function mainCities(){
        return $this->hasOne(City::class,'id','city_id');
    }
    public function subRegion(){
        return $this->hasOne(City::class,'id','sub_region_id');
    }

    public function userLikes()
    {
        return $this->hasOne(UserLike::class, 'item_id', 'id');
    }
    public function comments()
    {
        return $this->hasMany(CompanyCommit::class, 'company_id', 'id')->whereNull('committer_id')->with(['users','company','committer'])->orderBy('created_at', 'desc');
    }

    public function posts()
    {
        return $this->hasMany(CompanyPost::class, 'company_id', 'id');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function userReservation()
    {
        return $this->hasMany(Reservation::class, 'company_id', 'id')->orderBy('created_at', 'DESC');
    }
    public function companyReservation()
    {
        return $this->hasMany(Reservation::class, 'company_id', 'id')->orderBy('created_at', 'DESC');
    }

    public function companyService() {
        return $this->hasMany(CompanyService::class, 'company_id', 'id')->with('category','subCategory')->orderBy('sub_category_id','ASC');
    }

    public function companyPersons()
    {
        return $this->hasMany(CompanyPerson::class, 'company_id', 'id')->orderBy('id','DESC');
    }
}
