<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'id','parent_id','sub_category_id','image','title','slug','is_persons','is_reservation','status','type','created_at','updated_at'
    ];

    protected $casts = [
        'title' => 'array',
        'slug' => 'array',
    ];

    public function translations()
    {
        return $this->hasOne(Translation::class,'code','lang');
    }

    public function parentcategories()
    {
        return $this->hasMany(Category::class,'parent_id','id')->whereNotNull('parent_id')->whereNull('sub_category_id')->with('subcategories');
    }

    public function subcategories()
    {
        return $this->hasMany(Category::class,'sub_category_id','id');/*->whereNotNull('sub_category_id','parent_id');*/
    }

    public function companies()
    {
        return $this->hasMany(Company::class,'category_id','id');
    }
    public function mapCompany()
    {
        return $this->hasOne(Company::class,'category_id','id')->with('category','mainCities')->where(['status'=>1]);
    }
    public function mapCompanies()
    {
        return $this->hasMany(Company::class,'category_id','id')->with('category')->where(['status'=>1]);
    }

    public function companiesIsPremium()
    {
        return $this->hasMany(Company::class,'category_id','id')->where(['is_premium'=>1, 'status'=>1])->orderBy('id','DESC');
    }

    public function companyServices() {
        return $this->hasMany(CompanyService::class,'sub_category_id','id')->where('status',1)->orderBy('id','DESC');
    }
}
