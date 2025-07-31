<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';

    protected $fillable = [
        'id','country_id','sub_region_id','name','slug','image','status', 'created_at','updated_at'
    ];

    protected $casts = [
        'name' => 'array',
        'slug' => 'array',
    ];

    public function parentCity()
    {
        return $this->hasMany(City::class,'sub_region_id','id')->orderBy('name->az','ASC');
    }
    
    public function subRegions()
    {
        return $this->hasMany(City::class,'sub_region_id','id')->orderBy('name->az','ASC');
    }

    public function companies()
    {
        return $this->hasMany(Company::class,'city_id','id');
    }
}
